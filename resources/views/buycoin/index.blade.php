@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <main class="content content-bg">

        <section class="main-bg flex align-center">
            <div class="main-wrapper center-align">
                <h1 class="white-title">
                    Door2Coin – The fast, simple and secure way to buy Bitcoins </h1>
                <p class="slider-sub-text">Buy Bitcoins securely with the currency and payment method of your
                    choice.</p>
                <div class="btn-slider-wrap">
                    <span id="js_buy_btc" class="btn big">Buy Bitcoins</span>
                </div>
                <img src="{{ asset('assets/images/main-bg.svg') }}" alt="" class="main-bg-img">
            </div>
        </section>

        <section class="black-grey-bg">
            <div class="main-wrapper flex flex-wrap align-center">
                <div class="buy-item">
                    <img src="{{ asset('assets/images/with_credit_card.svg') }}" alt="Buy Bitcoins with Credit card"
                         class="buy-img-1">
                    <h3 class="buy-title">Buy Bitcoins <span>using a credit card</span></h3>
                    <p>Purchase Bitcoins today with your choice of credit/debit card.</p>
                </div>
                <div class="buy-item">
                    <img src="{{ asset('assets/images/alternative_methods.svg') }}"
                         alt="Buy Bitcoins with Alternative Methods" class="buy-img-2">
                    <h3 class="buy-title">Buy Bitcoins <span>using an alternative payment method</span></h3>
                    <p>Purchase Bitcoins quickly and hassle-free with your preferred currency.</p>
                </div>
            </div>
        </section>
        <section class="main-wrapper pad-space-ver">

            <div class="tab-btn-wrapper hide active" data-min="" data-max="">
                <button class="js_tab-btn tab-btn active" data-tab="2" data-min="" data-max="" data-rate-id="2">
<span class="flex align-center">
<img src="{{ asset('assets/images/flag-EUR.png') }}" alt="EUR">
EUR </span>
                </button>
            </div>

            <div class="tab-item-wrapper">
                <div id="tab_2" class="js_tab block-wrapper flex flex-wrap align-center">
                    <div class="block-item ">
                        <p class="price">€ <span>200</span>
                            <span class="usd">
($ 242)
</span>
                            <span class="small">for</span>
                        </p>
                        <p class="price-btc">
                            <span id="select_amount1" class="amount">{{round(200 / $rate, 8)}}</span> BTC </p>
                        <p class="line-preloader"><span style="width: 98.2543%; overflow: hidden;"></span></p>
                        <span class="btn quick-offer-buy">Select</span>
                    </div>
                    <div class="block-item ">
                        <p class="price">€ <span>500</span>
                            <span class="usd">
($ 604)
</span>
                            <span class="small">for</span>
                        </p>
                        <p class="price-btc">
                            <span id="select_amount2" class="amount">{{round(500 / $rate, 8)}}</span> BTC </p>
                        <p class="line-preloader"><span style="width: 98.2543%; overflow: hidden;"></span></p>
                        <span class="btn quick-offer-buy">Select</span>
                    </div>
                    <div class="block-item popular-item">
                        <p class="popular-label">Popular</p>
                        <p class="price">€ <span>1 000</span>
                            <span class="usd">
($ 1 208)
</span>
                            <span class="small">for</span>
                        </p>
                        <p class="price-btc">
                            <span id="select_amount3" class="amount">{{round(1000 / $rate, 8)}}</span> BTC </p>
                        <p class="line-preloader"><span style="width: 98.2543%; overflow: hidden;"></span></p>
                        <span class="btn quick-offer-buy">Select</span>
                    </div>
                    <div class="block-item ">
                        <p class="price">€ <span>5 000</span>
                            <span class="usd">
($ 6 039)
</span>
                            <span class="small">for</span>
                        </p>
                        <p class="price-btc">
                            <span id="select_amount4" class="amount">{{round(5000 / $rate, 8)}}</span> BTC </p>
                        <p class="line-preloader"><span style="width: 98.2543%; overflow: hidden;"></span></p>
                        <span class="btn quick-offer-buy">Select</span>
                    </div>
                </div>
            </div>

            <div class="exchange-wrapper center-align" id="wallet_link">
                <h2 class="page-title">Exchange different amount</h2>

                <div class="amount-wrapper field-error-wrapper">
                    <label id="currencyAmountLabel" for="currencyAmount" class="amount-label cryptoamountLabel">Enter your amount</label>
                    <input id="currencyAmount" type="number" name="amount" class="form-field cryptoamountField" autocomplete="off"
                           ><i class="currencyAmountSymbol">€</i><span
                        class="clear-amount">✕</span>
                </div>
                <div class="range-error">
                    <span>Out of range.</span>
                </div>
                <div class="range-wrapper">
                    <div id="amount-range"
                         class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                        <div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min"></div>
                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span></div>
                    <div class="flex align-between amount-range-num">
                        <span>200</span>
                        <span>5000</span>
                    </div>
                </div>
                @if (Auth::check())
                    @if(count($wallets) != 0)
                    <div class="form-align-items">
                        <div class="select-wallet">
                            <div class="js-select select field-contactform-subject required has-success">
                                <label class="control-label select-wallet-label" for="contactform-subject"
                                       style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3); border-color: rgba(88, 96, 137, 0.3);">Select Type</label>
                                <select id="selectwallet" class="contact-input order-form-field not-empty"
                                        name="subject" aria-required="true" aria-invalid="false" required>
                                    <option  class="nms" value="-1" selected="" disabled="" style="display:none;">Select wallet type
                                    @foreach($wallets as $data)
                                        <option class="nms" value="{{$data->id}}">{{$data->type}}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="error-message"></div>
                            </div>
                            <div class="type-error">
                                <span>Please select wallet type.</span>
                            </div>
                        </div>

                    </div>
                    @endif
                @endif
                <div class="field-error-wrapper ">
                    <label id="cryptoWalletLabel" for="cryptoWalletField">Enter your recipient wallet address</label>
                    @if (Auth::check())
                        @if(count($wallets) != 0)
                            <input id="cryptoWalletField" type="text" name="cryptoWalletAddress" value="" class="form-field"
                                   autocomplete="off">
                        @else
                            <input id="cryptoWalletField" type="text" name="cryptoWalletAddress" value="" class="form-field"
                                   autocomplete="off">
                        @endif
                    @else
                        <input id="cryptoWalletField" type="text" name="cryptoWalletAddress" value="" class="form-field"
                               autocomplete="off">
                    @endif

                </div>
                <div class="wallet-error">
                    <span>Please input valid Wallet Address.</span>
                </div>
                <div class="exchange-bg">
                    <div class="exchange-value">
                        <div class="exchange-title"><p>Sending to Your Wallet:</p></div>
                        <div class="btn-exchange-wrap">
<span class=" different-amount-buy ">
<span><span class="amount">0.02046096</span> BTC</span>
</span>
                        </div>
                        <div class="exchange-main-currency">
                            <span> for <input id="currencyAmount2" type="text" name="amount"
                                                                   class="form-field" autocomplete="off" disabled=""> EUR</span></div>
                        <p class="line-preloader"><span style="width: 137.721%; overflow: hidden;"></span></p>
                    </div>
                </div>

                <div class="btn-exchange-wrap">
<span class="btn big different-amount-buy exchange-btn">
Buy Bitcoin Now </span>
                </div>
            </div>
            <form method="post" id="paymentForm" data-validation-url="/validate-payment">
                <input type="hidden" id="rateId" name="PaymentForm[rateId]" value="2">
                <input type="hidden" id="amount" name="PaymentForm[amount]" value="1000">
                <input type="hidden" id="cryptoWallet" name="PaymentForm[cryptoWallet]"></form>
            <form method="post" action="https://wallet.advcash.com/sci/" id="buycoin_form">
                <input type="hidden" name="ac_account_email" value="alex@minersold.com" />
                <input type="hidden" name="ac_sci_name" value="Door2Coin.com" />
                <input type="hidden" name="ac_amount" value="1.00" />
                <input type="hidden" name="ac_currency" value="EUR" />
                <input type="hidden" name="ac_order_id" value="123456789" />
                <!-- Optional Fields -->
                <input type="hidden" name="ac_success_url" value="http://www.door2coin.com/buycoin/success" />
                <input type="hidden" name="ac_success_url_method" value="GET" />
                <input type="hidden" name="ac_fail_url" value="http://www.door2coin.com/buycoin/fail" />
                <input type="hidden" name="ac_fail_url_method" value="GET" />
                <input type="hidden" name="ac_status_url" value="http://www.door2coin.com/buycoin/status" />
                <input type="hidden" name="ac_status_url_method" value="GET" />
                <input type="hidden" name="ac_comments" value="Comment" />
            </form>
        </section>

        <section class="light-bg">
            <div class="main-wrapper flex align-between-top flex-colum-items">
                <div class="benefit-item flex align-between-top">
                    <img src="{{ asset('assets/images/icon1.svg') }}" alt="Plan your investments" class="benefit-icon">
                    <div class="benefit-info">
                        <h4 class="benefit-title">Organize Your Investments</h4>
                        <div>
                            <p>Choose your investment budget and see how much cryptocurrency you can buy.</p>
                        </div>
                    </div>
                </div>
                <div class="benefit-item flex align-between-top">
                    <img src="{{ asset('assets/images/icon2.svg') }}" alt="Total confidentiality" class="benefit-icon">
                    <div class="benefit-info">
                        <h4 class="benefit-title">Confidentiality &amp; Security</h4>
                        <div>
                            <p>We comply with the GDPR requirements and protect our clients information by using
                                encryption systems such as SSL to ensure the security of our clients' transactions.</p>
                        </div>
                    </div>
                </div>
                <div class="benefit-item flex align-between-top">
                    <img src="{{ asset('assets/images/icon3.svg') }}" alt="Terms &amp; Conditions" class="benefit-icon">
                    <div class="benefit-info">
                        <h4 class="benefit-title">100% Protection</h4>
                        <div>
                            <p>
                                All our clients' transactions are encrypted to ensure the maximum security, refer to our
                                <a href="{{route('termsofservice')}}" target="_blank">Terms of Service</a> for more details.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="benefit-item flex align-between-top">
                    <img src="{{ asset('assets/images/icon4.svg') }}" alt="Terms &amp; Conditions" class="benefit-icon">
                    <div class="benefit-info">
                        <h4 class="benefit-title">Fast-track verification</h4>
                        <div>
                            <p>
                                Complete your registration set up and start purchasing in minutes. </p>
                        </div>
                    </div>
                </div>
                <div class="benefit-item flex align-between-top">
                    <img src="{{ asset('assets/images/icon6.svg') }}" alt="Terms &amp; Conditions" class="benefit-icon">
                    <div class="benefit-info">
                        <h4 class="benefit-title">World Class Support</h4>
                        <div>
                            <p>
                                Our team of Happiness Heroes stands by to help out with anything - any time. </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="content-bg how-it-works">
            <div class="text-center">
                <p class="title">How do I Buy Bitcoins?</p></div>
            <div class="flex justify-content-between">
                <div class="part start">
                    <div class="icon-start">
                    </div>
                    <div class="title">
                        <span>1.</span> Sign Up
                    </div>
                    <div class="text">
                        Your personal data is fully encrypted and stored on protected servers
                    </div>
                </div>
                <hr class="dashed">
                <div class="part midle">
                    <div class="icon-midle">
                    </div>
                    <div class="title">
                        <span>2.</span> Select the amount
                    </div>
                    <div class="text">
                        Indicate the amount of Bitcoin you would like to purchase
                    </div>
                </div>
                <hr class="dashed">
                <div class="part end">
                    <div class="icon-end">
                    </div>
                    <div class="title">
                        <span>3.</span> Complete Order
                    </div>
                    <div class="text">
                        Enter the final payment details and complete your bitcoin purchase.
                    </div>
                </div>
            </div>

            <div class="text-center button-start">
                <div class="btn-slider-wrap ">
                    <a href="{{ route('auth.signup') }}" class="btn big">Start Now</a>
                </div>
            </div>
        </section>
        <div class="faq-main">
            <div class="inner-wrapper">
                <h1 class="main-faq-title">
                    Frequently Asked Questions </h1>
                <div class="dropdown-wrapper">

                    <button class="dropdown">Getting Started / The basics</button>

                    <ul class="nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#first_tab"
                                                                  aria-controls="first_tab" role="tab"
                                                                  data-toggle="tab">Getting Started / The basics</a>
                        </li>
                        <li role="presentation"><a href="#second_tab" aria-controls="second_tab"
                                                   role="tab" data-toggle="tab">Top Questions</a></li>
                        <li role="presentation"><a href="#third_tab" aria-controls="third_tab"
                                                   role="tab" data-toggle="tab">Wallet and Security /<br> Help
                                Topics</a></li>
                        <li role="presentation"><a href="#fourth_tab" aria-controls="fourth_tab"
                                                   role="tab" data-toggle="tab">Verification</a></li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="first_tab">

                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>What is bitcoin?</span>
                            </h4>
                            <div class="question-text">
                                <p>Bitcoin is a form of digital currency, created and held electronically. It is the
                                    first decentralized peer-to-peer payment network that is powered by its users
                                    without having a central authority or middlemen involved.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>How long does it take for Door2Coin to send my bitcoins once I’ve paid?</span>
                            </h4>
                            <div class="question-text">
                                <p>Door2Coin sends Bitcoins immediately after the client’s payment details have been
                                    confirmed and authenticated. Delays might occur as a result of purchasing outside of
                                    business hours (GMT) or regardless of hours of operation.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>What methods of payment does Door2Coin offer?</span>
                            </h4>
                            <div class="question-text">
                                <p>At Door2Coin, you can purchase Bitcoins with your choice of credit/debit card or by
                                    using an alternative payment method.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>What if I want to buy more/less coins than the amounts offered?</span>
                            </h4>
                            <div class="question-text">
                                <p>If you would like to buy different amounts, please use the “Slider” (the price
                                    calculator) located at the bottom of the homepage or the input for entering the
                                    desired sum.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Can I cancel a Bitcoin transaction after it was processed?</span>
                            </h4>
                            <div class="question-text">
                                <p>Bitcoin transactions are irreversible once they been broadcasted to the blockchain
                                    (regardless if the order is processed or confirmed). Therefore, even if you send a
                                    transaction to an invalid address or confirm a transaction by mistake, it cannot be
                                    reversed.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>How can I prove that a bitcoin transfer was made?</span>
                            </h4>
                            <div class="question-text">
                                <p>By checking http://blockchain.info/address/YOURADDRESS, you will be able to view the
                                    records of the coins you’ve purchased, which were sent to or from your address.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Are my payment details saved in your system?</span>
                            </h4>
                            <div class="question-text">
                                <p>Door2Coin keeps the regular BIN (meaning saved are first 6 and last 4 digits of the
                                    card number). Your card details will be used to process payment transactions through
                                    our system to your E-wallet as well as to help us verify your registration, comply
                                    with our legal and regulatory obligations, and help us prevent and detect fraud and
                                    crime.</p>
                            </div>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="second_tab">

                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>What currencies does Door2Coin accept?</span>
                            </h4>
                            <div class="question-text">
                                <p>Door2Coin accepts all types of currencies, so you’ll be able to purchase Bitcoins
                                    with
                                    your local currency using your credit card or alternative payment method. Since the
                                    pricing in the site is displayed with Euros, Door2Coin will be converting your
                                    transaction into Euros. Conversion fees may apply.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Why do I see a charge on my bank account but did not receive the coins yet?</span>
                            </h4>
                            <div class="question-text">
                                <p>If your payment hasn’t been approved yet, the charge you see on your account is most
                                    likely an authorization check, which is created immediately after a payment attempt
                                    was made. This is necessary to “save” the transaction amount in case the payment is
                                    approved. In the event that the payment is declined, the charge will automatically
                                    void within 48 hours, depending on your bank’s policy.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Is Bitcoin anonymous?</span>
                            </h4>
                            <div class="question-text">
                                <p>Bitcoin is often described as an anonymous payment network, but in reality, bitcoin
                                    is pseudonymous: all bitcoin transactions are public and traceable in the blockchain
                                    but without an individual's identity visibly attached to those transactions.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Does Door2Coin facilitate trades between buyers and sellers?</span>
                            </h4>
                            <div class="question-text">
                                <p>Absolutely not. Any transaction that is made through the site is solely between you
                                    and Door2Coin. We purchase the Bitcoins for you in real-time from our exchange
                                    vendor
                                    once the transaction is approved.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>How do I contact Door2Coin customer support?</span>
                            </h4>
                            <div class="question-text">
                                <p>If you have not found what you were looking for in our FAQ section, feel free to
                                    communicate with our customer support team, available through our <a
                                        href="{{route("contact.index")}}" rel="nofollow">contact us</a> page.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Does Door2Coin support other Cryptocurrencies besides Bitcoin?</span>
                            </h4>
                            <div class="question-text">
                                <p>You can only purchase Bitcoins with your Door2Coin registration. As Door2Coin solely
                                    works with BTC, any transaction from other cryptocurrencies such as Bitcoin Cash,
                                    Ethereum, Litecoin, Ripple, etc., are not supported.</p>
                            </div>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="third_tab">

                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Where can I get a Bitcoin wallet?</span>
                            </h4>
                            <div class="question-text">
                                <p>In order to download your own Bitcoin wallet for free, we suggest that you visit <a
                                        href="https://blockchain.info/ru/wallet/" target="_blank">www.blockchain.info/wallet</a>
                                    and follow the on-screen instructions.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>How do I change the email address associated with my Door2Coin registration?</span>
                            </h4>
                            <div class="question-text">
                                <p>If you'd like to change the email address associated with your registration, please
                                    contact us and we'll help you change it. If your primary email address will change,
                                    make sure to let us know before you no longer have access to it.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>How does Door2Coin determine the Bitcoin price?</span>
                            </h4>
                            <div class="question-text">
                                <p>Door2Coin uses market rates from several different exchanges in order to calculate
                                    the
                                    price of Bitcoin.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Why does Door2Coin ask for my personal information?</span>
                            </h4>
                            <div class="question-text">
                                <p>Door2Coin aims to provide global banking services for bitcoin, but is not assigned to
                                    provide an anonymous service. By providing some basic information, our users will
                                    help Door2Coin and the bitcoin community to create equally convenient security and
                                    consumer protection and ultimately bring more trust to Bitcoin.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>What are the processing fees?</span>
                            </h4>
                            <div class="question-text">
                                <p>Processing fees are necessary charges that customers need to pay in order to perform
                                    a transaction. They represent the amount of money that&nbsp;Door2Coin is charged by
                                    a
                                    bank&nbsp;or a service for an incoming wire, direct debit or cash deposit. These
                                    fees can be received by Door2Coin through the fulfillment by the customer during
                                    payment. In some instances, Door2Coin may choose to reduce or simply not charge the
                                    processing fee for some operations during a certain period of time, or the fee may
                                    be eliminated if it is no longer charged to Door2Coin.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Are there any restricted states where I can’t purchase Bitcoin from?</span>
                            </h4>
                            <div class="question-text">
                                <p>Due to regulation limitations, Door2Coin is currently prohibited from operating in
                                    various countries. Please refer to section 6.4 in our <a
                                        href="{{route('termsofservice')}}" target="_blank">Terms of
                                        Service</a> for the complete list.</p>
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>I’ve paid, but my order was not released. What should I do?</span>
                            </h4>
                            <div class="question-text">
                                <p>Your orders are released as soon as there’s a confirmation that your payment was
                                    successfully received. If you've paid but are still waiting, there is nothing to
                                    worry about, your Bitcoin is waiting for the funds to arrive in their bank. There
                                    can also be delays if you are transferring between different banks or it's a holiday
                                    or weekend. But don't worry, while your order is opened we are holding the funds in
                                    your name.</p>
                            </div>
                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="fourth_tab">

                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Government issued ID</span>
                            </h4>
                            <div class="question-text">
                                <p>A coloured copy of a government issued ID (passport, ID Card or Driver’s License both
                                    sides). Must be valid and not expiring in less than 3 months.</p>
                                <img src="{{ asset('assets/images/id.png') }}" class="verification-img"
                                     alt="Passport or ID card">
                            </div>
                        </div>
                        <div class="question-item">
                            <h4 class="question-title">
                                <span class="num"><i class="icon-back"></i></span>
                                <span>Proof of address</span>
                            </h4>
                            <div class="question-text">
                                <p>Bank statement showing at least 5 transactions or a utility bill (such as
                                    electricity, gas, water or landline/internet bill/TV license).</p>
                                <p>This document should include your full name and address and should not be older than
                                    3 months. For the convenience of our customers, you may submit the necessary
                                    documentation directly. We accept the following formats: jpg, jpeg, tif, png, gif,
                                    pdf, and doc. We do not accept compressed formats or links. Please ensure the
                                    documents are clear and legible.</p>
                                <p>For the convenience of our customers, you may submit the necessary documentation
                                    directly. We accept the following formats: jpg, jpeg, tif, png, gif, pdf, and doc.
                                    We do not accept compressed formats or links. Please ensure the documents are clear
                                    and legible.</p>
                                <p>Please send the copies of your documents to <a href="mailto:support@door2coin.com">support@door2coin.com</a>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="btn-slider-wrap faq-btn-main">
                    <a href="{{route("faq.index")}}" class="btn big main-faq">Have More Questions?</a>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('moreScript')
    <script src="{{ asset('js/paymentForm.js') }}"></script>
@endsection

@section('afterScript')
    <script>
        $ = jQuery;
        $(window).on('load', function() {
            // code here
            var wrapsHeight = $('.tab-item-wrapper').offset().top - 50;

            $('html, body').stop().animate({
                'scrollTop': wrapsHeight
            }, 800, 'swing');
        });
    </script>
    <script>
        window.GLOBALS = window.GLOBALS ? window.GLOBALS : {};
        window.GLOBALS.rate = {{$rate}};
        jQuery(function ($) {
            $('#currencyAmountLabel').text('Enter your amount');
        });</script>
    <script>
        $ = jQuery;
        $(document).ready(function () {
            $('select, textarea, #currencyAmount, #cryptoWalletField').focus(function (e) {
                $(this).prev().css({"background-color": "#F6F9FE", "color": "#4441D4", "border-color": "#4441D4"});
            });
            $('select, textarea, #currencyAmount, #cryptoWalletField').blur(function (e) {
                $(this).prev().css({
                    "background-color": "#F6F9FE",
                    "color": "rgba(88, 96, 137, 0.3)",
                    "border-color": "rgba(88, 96, 137, 0.3)"
                });
            });

            $('input.order-form-field').focus(function (e) {
                $(this).prev().css({"background-color": "#F6F9FE", "color": "#4441D4"});
            });

            $('input.order-form-field').blur(function (e) {
                $(this).prev().css({"background-color": "#F6F9FE", "color": "rgba(88, 96, 137, 0.3)"});
            });
            $('.reloadable input.order-form-field').focus(function (e) {
                $(this).prev().css({"background-color": "#fff", "color": "#4441D4"});
            });

            $('.reloadable input.order-form-field').blur(function (e) {
                $(this).prev().css({"background-color": "#fff", "color": "rgba(88, 96, 137, 0.3)"});
            });
            $('.question-item i').click(function(e){
                $(this).parent().parent().parent().toggleClass('active-question');
            });

        });

    </script>
    @if(Auth::check())
        <script>

            $ = jQuery;
            $(window).on('load', function() {
                // code here
                let wallet_ids = {{$wallet_id}};

                // code here
                if(wallet_ids != -1) {

                    var wrapsHeight = $('.exchange-wrapper').offset().top - 50;

                    $('html, body').stop().animate({
                        'scrollTop': wrapsHeight
                    }, 800, 'swing');
                }
            });
            $(document).ready(function () {
                let walletarray = @json($wallets);
                let wallet_id = {{$wallet_id}};
                if(wallet_id != -1) {
                    let index = walletarray.findIndex(x=> x.id == wallet_id);
                    $('#cryptoWalletField').val(walletarray[index].wallet_address);
                    $('#selectwallet').val(wallet_id);
                }
                if(walletarray.length == 0) {
                    let f_flag = false;
                    let s_flag = false;

                    if(window.localStorage.getItem('wallet_address') != null && window.localStorage.getItem('wallet_address') != '-1'){
                        f_flag = true;
                        $('#cryptoWalletField').val(window.localStorage.getItem('wallet_address'));
                    }
                    if(window.localStorage.getItem('amount') != null && window.localStorage.getItem('amount') != '-1'){
                        s_flag = true;
                        $('#currencyAmount').val(window.localStorage.getItem('amount'));
                    }
                    if(s_flag && f_flag) {
                        var wrapsHeight = $('.exchange-wrapper').offset().top - 50;
                        $('html, body').stop().animate({
                            'scrollTop': wrapsHeight
                        }, 800, 'swing');
                    }
                }
                $('#selectwallet').on('change', function() {

                    let index = walletarray.findIndex(x=> x.id == this.value);
                    $('#cryptoWalletField').val(walletarray[index].wallet_address);
                });
                $('.exchange-btn').click(function () {
                    if($('#currencyAmount').val() < window.GLOBALS.minCurrencyAmount || $('#currencyAmount').val() > window.GLOBALS.maxCurrencyAmount) return;
                    window.localStorage.setItem('wallet_address', '-1');
                    window.localStorage.setItem('amount', '-1');
                    let v = normalize($('#cryptoWalletField').val());
                    let result = check(v);
                    if(!result) {
                        $('.wallet-error').show();
                        return;
                    }
                    let type = -1;
                    if(walletarray.length != 0) {
                        type = $('#selectwallet').val();
                        if(type == undefined) {
                            $('.type-error').show();
                            return;
                        }
                    }
                    $('input[name="ac_amount"]').val(parseInt($('#currencyAmount').val()));
                    // cryptoWalletField
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    let $form = $('#buycoin_form');
                    $.ajax({
                        type: 'post',
                        url: '/getTransactionId',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            ac_amount: $('input[name="ac_amount"]').val(),
                            ac_currency: "EUR",
                            ac_comments: "comment",
                            wallet_address: $('#cryptoWalletField').val(),
                            type: type
                        },
                        context: $form,
                        success: function(response) { // your success handler
                            console.log(response.data);
                            $('input[name="ac_success_url"]').val('http://www.door2coin.com/buycoin/success/' + response.data.id);
                            $('input[name="ac_fail_url"]').val('http://www.door2coin.com/buycoin/fail/' + response.data.id);
                            $('input[name="ac_status_url"]').val('http://www.door2coin.com/buycoin/status/' + response.data.id);
                            $('input[name="ac_order_id"]').val(response.data.order_id);
                        },
                        error: function() { // your error handler
                        },
                        complete: function() {
                            // make sure that you are no longer handling the submit event; clear handler

                            this.off('submit');
                            // // actually submit the form
                            this.submit();
                        }
                    });
                })
            });

        </script>
    @else
        <script>
            // $(document).ready(function () {
            //     if(window.localStorage.getItem('wallet_address') != null){
            //         $('#cryptoWalletField').val(window.localStorage.getItem('wallet_address'));
            //     }
            //     if(window.localStorage.getItem('amount') != null){
            //         $('#currencyAmount').val(window.localStorage.getItem('amount'));
            //     }
            // });
            $('.exchange-btn').click(function () {
                if($('#currencyAmount').val() < window.GLOBALS.minCurrencyAmount || $('#currencyAmount').val() > window.GLOBALS.maxCurrencyAmount) return;
                window.localStorage.setItem('wallet_address', $('#cryptoWalletField').val());
                window.location.href = 'login';
                window.localStorage.setItem('amount', $('#currencyAmount').val());
            })
        </script>
    @endif
    <script>
        $ = jQuery;
        $(document).ready(function () {
            $(".main-menu #m_buycoin").addClass("active");
            window.GLOBALS = window.GLOBALS ? window.GLOBALS : {};
            $('.clear-amount').on('click', function () {
                $('#currencyAmount').val('0');
                $('.range-error').show();
                $('.exchange-btn').addClass('active');
            });

            // window.GLOBALS.minCurrencyAmount;
            // window.GLOBALS.maxCurrencyAmount ;

            $( "#amount-range" ).click(function() {
                $('.range-error').hide();
                $('.exchange-btn').removeClass('active');
            });
             $( ".ui-slider-handle" ).mousedown(function() {
                $('.range-error').hide();
                $('.exchange-btn').removeClass('active');
            });
            $('#currencyAmount').on("change paste keyup",function(){
                if($(this).val() < window.GLOBALS.minCurrencyAmount || $(this).val() > window.GLOBALS.maxCurrencyAmount) {
                    $('.range-error').show();
                    $('.exchange-btn').addClass('active');
                } else {
                    $('.range-error').hide();
                    $('.exchange-btn').removeClass('active');
                }
            });
        });
    </script>
@endsection

