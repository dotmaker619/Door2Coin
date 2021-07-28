jQuery(document).ready(function ($) {
    'use strict';
    window.GLOBALS = window.GLOBALS ? window.GLOBALS : {};
    window.GLOBALS.minCurrencyAmount = 200;
    window.GLOBALS.maxCurrencyAmount = 5000;

    var defaultCountDownTimerDuration = 60000;

    var debug = false;

    var EventTrigger = (function() {
        var instance;

        function createInstance() {
            return {
                send: function(eventName, data, senderName) {
                    $(document).trigger(eventName, data);
                    if (debug) {
                        console.log('/******** ' + senderName + ' -> ' + eventName + ' ********/');
                        console.log(data);
                    }
                }
            };
        }

        return {
            getInstance: function() {
                if (!instance) {
                    instance = createInstance();
                }
                return instance;
            }
        };
    })();

    var Currencies = (function() {
        var instance;

        function createInstance() {
            return {
                currencyAmount: 0,
                $currentCurrency: null,
                $currentCryptoCurrency: null,
                rates: {},
                setCurrentCurrency: function($currency) {
                    this.$currentCurrency = $currency;
                    this.calculateAmounts(this.currencyAmount);
                },
                setCurrentCryptoCurrency: function($cryptoCurrency) {
                    this.$currentCryptoCurrency = $cryptoCurrency;
                    this.calculateAmounts(this.currencyAmount);
                },
                getCurrentRateId: function() {
                    if (!this.$currentCurrency) {
                        return null;
                    }

                    return this.$currentCurrency.data('rate-id');
                },
                updateRates: function(rates) {
                    Object.keys(rates).forEach(function(rateId) {
                        this.rates[rateId] = rates[rateId];
                    }, this);

                    this.calculateAmounts(this.currencyAmount);

                    EventTrigger.getInstance().send('ratesUpdated', {
                        rates: this.rates,
                        currentRateId: this.getCurrentRateId()
                    }, 'Currencies');
                },
                calculateAmounts: function(currencyAmount) {
                    var cryptoCurrencyAmount = currencyAmount / window.GLOBALS.rate;
                    EventTrigger.getInstance().send('amountsChanged', {
                        'currencyAmount': currencyAmount,
                        'cryptoCurrencyAmount': cryptoCurrencyAmount
                    }, 'Currencies');
                    this.validateAmounts(currencyAmount, cryptoCurrencyAmount);
                },
                validateAmounts: function(currencyAmount, cryptoCurrencyAmount) {
                    var amountHasError = !this.checkAmount(currencyAmount, this.$currentCurrency)
                        || !this.checkAmount(cryptoCurrencyAmount, this.$currentCryptoCurrency);

                    EventTrigger.getInstance().send('validationError', {
                        'field': 'amount',
                        'hasError': amountHasError,
                        'description': ''
                    }, 'Currencies');
                },
                checkAmount: function(amount, currency) {
                    if (!currency) {
                        return false;
                    }
                    if (currency.data('min') && parseFloat(amount) < currency.data('min')) {
                        return false;
                    }
                    if (currency.data('max') && parseFloat(amount) > currency.data('max')) {
                        return false;
                    }
                    return true;
                },
                init: function() {

                }
            };
        }

        return {
            getInstance: function () {
                if (!instance) {
                    instance = createInstance();

                    $(document).on('currencyTabChanged', function(event, data) {
                        instance.setCurrentCurrency(data.$currency);
                    });

                    $(document).on('cryptoCurrencyTabChanged', function(event, data) {
                        instance.setCurrentCryptoCurrency(data.$cryptoCurrency);
                    });

                    $(document).on('ratesReceived', function(event, data) {
                        instance.updateRates(data.rates);
                    });

                    $(document).on('currencyAmountChanged', function(event, data) {

                        instance.currencyAmount = data.currencyAmount;
                        instance.calculateAmounts(data.currencyAmount);
                    });
                }
                return instance;
            }
        };
    })();

    var PaymentData = (function() {
        var instance;

        var $paymentForm = $('#paymentForm');

        function createInstance() {
            return {
                $form: $paymentForm,
                $rateId: $paymentForm.find('#rateId'),
                $amount: $paymentForm.find('#amount'),
                $cryptoWallet: $paymentForm.find('#cryptoWallet'),
                $exchangeWrapper: $('.exchange-wrapper'),
                processingClass: 'in-progress',
                setAmount: function(amount) {
                    this.$amount.val(
                        parseFloat(amount).toFixed(2)
                    );
                },
                setRateId: function(rateId) {
                    this.$rateId.val(parseInt(rateId, 10));
                },
                setCryptoWallet: function(cryptoWallet) {
                    this.$cryptoWallet.val(cryptoWallet);
                },
                getValidationUrl: function() {
                    return this.$form.data('validationUrl');
                },
                init: function() {
                    EventTrigger.getInstance().send('currencyAmountChanged', {
                        'currencyAmount': this.$amount.val()
                    }, 'PaymentData');
                    let myVar = setInterval(myTimer, 5000);

                    function myTimer() {
                        $.ajax({
                            type: "get",
                            url: "/get-rate",
                            success: function (response) {
                                window.GLOBALS.rate = response;
                                $('#select_amount1').text(parseFloat(242/window.GLOBALS.rate).toFixed(8));
                                $('#select_amount2').text(parseFloat(604/window.GLOBALS.rate).toFixed(8));
                                $('#select_amount3').text(parseFloat(1208/window.GLOBALS.rate).toFixed(8));
                                $('#select_amount4').text(parseFloat(6039/window.GLOBALS.rate).toFixed(8));
                            },
                            error: function () {

                            },
                        });
                        let amountval = $('#currencyAmount').val();
                        EventTrigger.getInstance().send('currencyAmountChanged', {
                            'currencyAmount': amountval
                        }, 'PaymentData');
                    }
                }
            };
        }

        return {
            getInstance: function() {
                if (!instance) {
                    instance = createInstance();

                    $(document).on('currencyTabChanged', function(event, data) {
                        instance.setRateId(data.$currency.data('rate-id'));
                    });

                    $(document).on('amountsChanged', function(event, data) {
                        instance.setAmount(data.currencyAmount);
                    });

                    $(document).on('cryptoWalletChanged', function(event, data) {
                        instance.setCryptoWallet(data.cryptoWallet);
                    });

                    $(document).on('formSubmitted', function(event, data) {

                        instance.$exchangeWrapper.addClass(instance.processingClass);

                        $.ajax({
                            type: "POST",
                            url: instance.getValidationUrl(),
                            data: instance.$form.serialize(),
                            success: function (response) {

                                instance.$exchangeWrapper.removeClass(instance.processingClass);

                                if (response.isValid === false) {

                                    if (
                                        response.hasOwnProperty('errors')
                                    ) {
                                        for (var fieldName in response.errors) {
                                            if(!response.errors.hasOwnProperty(fieldName)) {
                                                continue;
                                            }
                                            EventTrigger.getInstance().send('validationError', {
                                                'field': fieldName,
                                                'hasError': true,
                                                'description': response.errors[fieldName],
                                            }, 'PaymentData');

                                        }
                                        EventTrigger.getInstance().send('showValidationErrors', {}, 'PaymentData');
                                    }
                                } else {
                                    instance.$form.submit();
                                }
                            },
                            error: function () {
                                instance.$exchangeWrapper.removeClass(instance.processingClass);
                            },
                        });
                    });
                }
                return instance;
            }
        };
    })();

    var BuyButton = (function() {
        var instance;

        var $buttonWrapper = $('.btn-exchange-wrap');

        function createInstance() {
            return {
                $buttonWrapper: $buttonWrapper,
                $button: $buttonWrapper.find('.btn'),
                fieldsErrors: {
                    amount: false,
                    cryptoWallet: false,
                },
                setAmount: function(amount) {
                    this.$buttonWrapper.find('.amount').first().text(
                        parseFloat(amount).toFixed(8)
                    );
                },
                canBeSubmitted: function() {
                    for (var fieldHasError in this.fieldsErrors) {
                        if (
                            this.fieldsErrors.hasOwnProperty(fieldHasError)
                            && this.fieldsErrors[fieldHasError]
                        ) {
                            return false;
                        }
                    }
                    return true;
                },
                submitForm: function() {
                    if (this.canBeSubmitted()) {
                        EventTrigger.getInstance().send('formSubmitted', {}, 'BuyButton');
                    } else {
                        EventTrigger.getInstance().send('showValidationErrors', {}, 'BuyButton');
                    }
                },
                init: function() {

                }
            };
        }

        return {
            getInstance: function () {
                if (!instance) {
                    instance = createInstance();

                    instance.$button.click(function() {
                        instance.submitForm();
                    });

                    $(document).on('amountsChanged', function(event, data) {
                        instance.setAmount(data.cryptoCurrencyAmount);
                    });

                    $(document).on('validationError', function (event, data) {
                        var fieldName = data.field;
                        instance.fieldsErrors[fieldName] = data.hasError;
                    });
                }
                return instance;
            }
        };
    })();

    var CountDownTimer = (function() {
        var instance;

        function createInstance() {
            return {
                $lineSpan: $('.line-preloader').find('span'),
                duration: defaultCountDownTimerDuration,
                doCountDown: function(timeLeft) {
                    this.$lineSpan.animate({'width': '0%'}, timeLeft, 'linear');
                },
                startCountDown: function(timeLeft) {
                    timeLeft = timeLeft || this.duration;
                    this.$lineSpan.stop();
                    this.$lineSpan.css({
                        'width': ((timeLeft / this.duration) * 100) + '%'
                    });
                    this.doCountDown(timeLeft);
                },
                init: function() {

                }
            };
        }

        return {
            getInstance: function () {
                if (!instance) {
                    instance = createInstance();

                    $(document).on('ratesReceived', function(event, data) {
                        instance.startCountDown(data.timeLeft);
                    });
                }
                return instance;
            }
        };
    })();

    var AmountInput = (function() {
        var instance;

        var $amountRange = $('#amount-range');

        var $rangeerror = $('.range-error');
        var $exchangebtn = $('.exchange-btn');
        $amountRange.slider({
            range: 'min',
            value: window.GLOBALS.minCurrencyAmount,
            min: window.GLOBALS.minCurrencyAmount,
            max: window.GLOBALS.maxCurrencyAmount
        });

        function createInstance() {
            return {
                $label: $('#currencyAmountLabel'),
                $input: $('#currencyAmount, #currencyAmount2'),
                $amountRange: $amountRange,
                $rangeerror: $rangeerror,
                $exchangebtn: $exchangebtn,
                hasError: false,
                setLabel: function(label) {
                    this.$label.text(label);
                },
                setAmount: function(amount) {
                    amount = parseFloat(amount);
                    this.$input.val(amount);
                    this.$amountRange.slider('value', amount);
                    removeError(this.$input);
                },
                getAmount: function() {
                    return this.$input.val();
                },
                onChange: function() {

                    EventTrigger.getInstance().send('currencyAmountChanged', {
                        'currencyAmount': instance.getAmount()
                    }, 'AmountInput');
                },
                init: function() {

                }
            };
        }

        return {
            getInstance: function () {
                if (!instance) {
                    instance = createInstance();

                    instance.$input.keyup(function() {
                        instance.onChange();
                    });

                    instance.$input.change(function() {
                        instance.onChange();
                    });

                    instance.$amountRange.on('slide', function(event, ui) {
                        instance.setAmount(ui.value);
                        EventTrigger.getInstance().send('currencyAmountChanged', {
                            'currencyAmount': instance.getAmount()
                        }, 'AmountInput');
                    });

                    $(document).on('currencyTabChanged', function(event, data) {
                        instance.setLabel(data.currencySign);
                    });

                    $(document).on('amountsChanged', function(event, data) {
                        instance.setAmount(data.currencyAmount);
                    });

                    $(document)
                        .on('validationError', function (event, data) {
                            if (data.field === 'amount') {
                                instance.hasError = data.hasError;
                            }
                        })
                        .on('showValidationErrors', function (event, data) {
                            instance.hasError ? addError(instance.$input) : removeError(instance.$input);
                        });

                    $(document).on('quickOfferBuyButtonClicked', function(event, data) {
                        instance.setAmount(data.currencyAmount);
                        EventTrigger.getInstance().send('currencyAmountChanged', {
                            'currencyAmount': instance.getAmount()
                        }, 'AmountInput');
                    });
                }
                return instance;
            }
        };
    })();

    var CryptoWalletInput = (function() {
        var instance;

        function createInstance() {
            return {
                $input: $('#cryptoWalletField'),
                hasError: false,
                getCryptoWallet: function() {
                    return this.$input.val();
                },
                onChange: function() {
                    removeError(instance.$input);
                    instance.validate();
                    EventTrigger.getInstance().send('cryptoWalletChanged', {
                        'cryptoWallet': instance.getCryptoWallet()
                    }, 'CryptoWalletInput');
                },
                validate: function() {
                    var regExp = /^[13][a-km-zA-HJ-NP-Z0-9]{26,33}$/igm,
                        isValid = regExp.test(this.getCryptoWallet());

                    EventTrigger.getInstance().send('validationError', {
                        'field': 'cryptoWallet',
                        'hasError': !isValid,
                    }, 'CryptoWalletInput');

                    return isValid;
                },
                init: function() {
                    this.validate();
                }
            };
        }

        return {
            getInstance: function () {
                if (!instance) {
                    instance = createInstance();

                    instance.$input.keyup(function() {
                        instance.onChange();
                    });

                    instance.$input.change(function() {
                        instance.onChange();
                    });

                    $(document)
                        .on('validationError', function (event, data) {
                            if (data.field === 'cryptoWallet') {
                                instance.hasError = data.hasError;
                            }
                        })
                        .on('showValidationErrors', function (event, data) {
                            instance.hasError ? addError(instance.$input) : removeError(instance.$input);
                        });
                }
                return instance;
            }
        };
    })();

    var QuickOffersList = (function() {
        var instance;

        var $tabs = $('.js_tab');

        function createInstance() {
            return {
                $quickOfferTabs: $tabs,
                $buttons: $tabs.find('.block-item').find('.btn'),
                showTab: function(rateId) {
                    this.$quickOfferTabs.addClass('hide');
                    this.$quickOfferTabs.filter('#tab_' + rateId).removeClass('hide');
                },
                updateQuickOffersCryptoCurrencyAmount: function(rates) {
                    Object.keys(rates).forEach(function(rateId) {
                        instance.$quickOfferTabs.filter('#tab_' + rateId).find('.block-item').each(function() {
                            var currencyAmount = $(this).find('.price span').text();
                            // currencyAmount = parseInt(currencyAmount.replace(/ /g, ''), 10);
                            currencyAmount = parseInt(currencyAmount);
                            var cryptoCurrencyAmount = parseFloat(currencyAmount * rates[rateId]).toFixed(8);
                            $(this).find('.price-btc .amount').text(cryptoCurrencyAmount);
                        });
                    }, this);
                },
                init: function() {

                }
            };
        }

        return {
            getInstance: function () {
                if (!instance) {
                    instance = createInstance();

                    $(document).on('currencyTabChanged', function(event, data) {
                        instance.showTab(data.$currency.data('rate-id'));
                    });

                    $(document).on('ratesUpdated', function(event, data) {
                        instance.updateQuickOffersCryptoCurrencyAmount(data.rates);
                    });

                    instance.$buttons.click(function() {
                        // var currencyAmount = $(this).parent().find('.price span').text().replace(/ /g, '')
                        var currencyAmount = $(this).parent().find('.price span').text()
                        EventTrigger.getInstance().send('quickOfferBuyButtonClicked', {
                            currencyAmount: currencyAmount
                        }, 'QuickOffersList');

                        scrollToExchangeWrapper();
                    });
                }
                return instance;
            }
        };
    })();

    var CurrencyList = (function() {
        var instance;
        var currencySigns = GLOBALS.currencySigns;

        function getCurrencyLabel(currencyCode) {
            return currencySigns.hasOwnProperty(currencyCode) ? currencySigns[currencyCode] : '';
        }

        var $switchers = $('button.js_tab-btn');

        function createInstance() {
            return {
                $switchers: $switchers,
                $currentTab: $switchers.filter('.active').length ? $switchers.filter('.active') : $switchers.first(),
                setTab: function($tab) {
                    this.$currentTab = $tab || this.$currentTab;
                    this.$switchers.removeClass('active');
                    this.$currentTab.addClass('active');

                    EventTrigger.getInstance().send('currencyTabChanged', {
                        currencySign: getCurrencyLabel(this.$currentTab.data('tab')),
                        $currency: this.$currentTab
                    }, 'CurrencyList');
                },
                init: function() {
                    this.setTab();
                }
            };
        }

        return {
            getInstance: function () {
                if (!instance) {
                    instance = createInstance();
                    instance.$switchers.click(function() {
                        instance.setTab($(this));
                    });
                }
                return instance;
            }
        };
    })();

    var CryptoCurrencyList = (function() {
        var instance;
        var $switchers = $('.tab-btn-wrapper');
        function createInstance() {
            return {
                $switchers: $switchers,
                $currentTab: $switchers.filter('.active').length ? $switchers.filter('.active') : $switchers.first(),
                setTab: function($tab) {
                    this.$currentTab = $tab || this.$currentTab;
                    this.$switchers.removeClass('active');
                    this.$currentTab.addClass('active');

                    EventTrigger.getInstance().send('cryptoCurrencyTabChanged', {
                        $cryptoCurrency: this.$currentTab
                    }, 'CurrencyList');
                },
                init: function() {
                    this.setTab();
                }
            };
        }

        return {
            getInstance: function() {
                if (!instance) {
                    instance = createInstance();
                }
                return instance;
            }
        };
    })();

    var currencies = Currencies.getInstance();
    var countDownTimer = CountDownTimer.getInstance();
    var buyButton = BuyButton.getInstance();
    var amountInput = AmountInput.getInstance();
    var cryptoWalletInput = CryptoWalletInput.getInstance();
    var paymentData = PaymentData.getInstance();
    var cryptoCurrencyList = CryptoCurrencyList.getInstance();
    var quickOffersList = QuickOffersList.getInstance();
    var currencyList = CurrencyList.getInstance();

    currencies.init();
    buyButton.init();
    amountInput.init();
    cryptoWalletInput.init();
    paymentData.init();
    countDownTimer.init();
    cryptoCurrencyList.init();
    quickOffersList.init();
    currencyList.init();
});
