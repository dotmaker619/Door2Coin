jQuery(document).ready(function ($) {
    'use strict';



	var $jsBuyBtc = $('#js_buy_btc');
	var $mainHeader = $('#mainHeader');
    var $toggleSelect = $('#js_toggle_select');
    var $mobileHandler = $('.mobile-handler');
    var $allowSlide = false;

/*======================================*/
// Click On Buy Bitcoins

	$jsBuyBtc.on('click', function(e) {
		e.preventDefault();
        scrollToExchangeWrapper();
	});

/*======================================*/
// Select Click

    $toggleSelect.on('click', function() {
        $allowSlide = true;
        $(this).toggleClass('active');
        $mobileHandler.stop().slideToggle(400);
    });
    if($('.exchange-wrapper').hasClass('has-token')) {
        scrollToExchangeWrapper();
    }
    /*======================================*/
// Scroll Menu

    function fixedHeader() {
        if ($(window).scrollTop() >= 150) {
            $mainHeader.addClass('stick');
        } else {
            $mainHeader.removeClass('stick');
        }
    }

    fixedHeader();
    $(window).scroll(fixedHeader);




    function change_text_dropdown() {
        var dropdown_text = $('.nav-tabs li.active a').text();
        $('button.dropdown').html(dropdown_text);
    }
    var dropdown_toggler = true;
    function dropdown_click() {
        change_text_dropdown();

        $('button.dropdown').click(function () {

            if(dropdown_toggler) {
                $(this).next('ul.nav-tabs').addClass('open-dropdown');
                dropdown_toggler = false;
            }
            else {
                $(this).next('ul.nav-tabs').removeClass('open-dropdown');
                dropdown_toggler = true;
            }
        });
    }
    dropdown_click();


    //FAQ Tabs
    var click_element = $('.nav-tabs li a');
    var tab_content = $('.tab-content .tab-pane');
     click_element.click(function (e) {
         e.preventDefault();
         e.stopPropagation();
         $('ul.nav-tabs').removeClass('open-dropdown');
         dropdown_toggler = true;
         var current_tab = $(this).attr('aria-controls');
         click_element.parent('li').removeClass('active');
         $(this).parent('li').addClass('active');
         change_text_dropdown();
         tab_content.removeClass('active');
         $('.tab-content #' + current_tab).addClass('active');

     });

    // FAQ accordion
    $('.question-item i').click(function(e){

        $(this).parent().parent().parent().find('.question-text').stop().toggle('fast');
        $(this).parent().parent().parent().find('.num').toggleClass('green');
    });


    //JUST FOR DESIGN DELETE IT, PLEASE
    $('#contact input:not([type="submit"])').keyup(function() {
        var empty = false;
        $('#contact input:not([type="submit"])').each(function() {
            if ($(this).val() === '' && $(this).prop('required')) {
                empty = true;
            }
            // else {
            //     $(this).addClass('not-empty');
            // }
        });
        if (empty) {
            $('#submit').attr('disabled', 'disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
        } else {

            $('#submit').removeAttr('disabled'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
        }
    });
    $(".js-select select" ).change(function() {
        $(".js-select select").addClass('not-empty');
    });

    function mobile_menu() {
        var clicker = false;
        var menu =  $('#menu-container');
        var overlay = $('#overlay');
        var close_button = $('#close');
        function close() {
            menu.removeClass('open');
            overlay.removeClass('full-screen')
            clicker = false;
        }
        $('#menu-button').click(function () {
            if (!clicker) {
                menu.addClass('open');
                overlay.addClass('full-screen')
                clicker = true;
            }
            else  {
               close();
            }
        });
        overlay.click(function () {
            close();
        });
        close_button.click(function () {
            close();
        });

    }

    mobile_menu();


    function change_tab() {
        $('.order-tab-btn.join-us').click(function () {
            $('.order-tab-btn').removeClass('active');
            $('.form-tab-item-wrap').removeClass('active-tab');
            $(this).addClass('active');
            var tab_name = $(this).attr('data-form');

            $('#' + tab_name).addClass('active-tab');

        })
    }
    change_tab();

    // hide temporal notes
    setTimeout(function(){
        $('.note-temporal').fadeOut();
    }, 6000);

    // add on registration form field intl-tel-input
    if (window.hasOwnProperty('intlTelInput')) {
        var inputPhone = document.querySelector('#registrationform-phone');
        var iti = window.intlTelInput(inputPhone, {
            initialCountry: GLOBALS.country,
            preferredCountries: [],
            separateDialCode: false,
        });

        if (inputPhone.value.indexOf('' + +iti.b.dataset.dialCode + '') === -1){
            inputPhone.value = '+' + iti.b.dataset.dialCode + inputPhone.value;
        }

        inputPhone.addEventListener("open:countrydropdown", function() {
            if (inputPhone.value.indexOf('' + +iti.b.dataset.dialCode + '') === -1){
                iti.j = iti.b.dataset.countryCode;
                iti.setCountry(iti.b.dataset.countryCode);
            }
            $(inputPhone).val(inputPhone.value);
        });

        inputPhone.addEventListener("close:countrydropdown", function() {
            if (inputPhone.value.indexOf('+') === -1) {
                inputPhone.value = '+' + iti.b.dataset.dialCode + inputPhone.value;
            }
            validInputPhone(inputPhone.value);
        });

        var errorTextPhone = inputPhone.parentNode.nextElementSibling;
        var divError = document.createElement('div');
        divError.className = 'error-message-number';
        // errorTextPhone.after(divError);

        inputPhone.oninput = function() {
            if(inputPhone.value.indexOf('' + +iti.b.dataset.dialCode + '') === -1) {
                iti.j = '';
            }
        };
        inputPhone.onblur = function() {
            changeInputPhone();
        };
        document.addEventListener('keydown', function(event) {
            var charCode = event.which ? event.which : event.keyCode;
            if (charCode === 13) {
                changeInputPhone();
            }
        });

        function changeInputPhone() {
            getTrimingPhone();
            inputPhone.value = iti.getNumber();
            validInputPhone(inputPhone.value);
        }
    }

    function getTrimingPhone() {
        inputPhone.value = inputPhone.value.split(/[.`^$*?{}\[\]\\|() \/_\-()!~@#№%='"<>:;]/).join("");
    }

    function validInputPhone(phone) {
        var fieldPhone = inputPhone.closest('.field-registrationform-phone');
        var errorDataPhone = $(fieldPhone).find('.error-message-number');
        var errorPhone = $(fieldPhone).find('.error-message');
        if($(inputPhone).val().length > 0 && !iti.isValidNumber(phone)) {
            $(fieldPhone).addClass('has-error-number');
            errorDataPhone.html('Phone is invalid.');
            $(errorPhone).css('display','none');
            return false;
        } else {
            $(fieldPhone).removeClass('has-error-number');
            errorDataPhone.html('');
            $(errorPhone).css('display','block');
            return true;
        }
    }

    function scrollToError(){
        if (typeof $('.has-error').first().offset() !== 'undefined'){
            $('html, body').animate({
                scrollTop: $('.has-error').first().offset().top - $('header').height()
            }, 1000);
        } else if (typeof $('.has-error-number').first().offset() !== 'undefined'){
            $('html, body').animate({
                scrollTop: $('.has-error-number').first().offset().top - $('header').height()
            }, 1000);
        }
    }

    $('.sign-up-form input[type="submit"]').on('click', function (e) {

    });

    $('input[type="submit"]').on('click', function (e) {
        var activeForm = $(this).parents('form');
        $(activeForm).find('input[type="text"]').each(function(){
            this.value = $(this).val().trim();
        });

        // scroll to error field in form
        $(activeForm).on('afterValidate', function () {
            scrollToError();
        });
    });

    // functions used to handle "RememberMe" popup
    $('.modal-overlay').on('click', function(e) {
        if (e.target !== this) {
            return;
        }
    });
    $('#rememberMe').on('click', function() {
        setRememberMe(true);
    });
    $('#notNow').on('click', function() {
        setRememberMe(false);
    });
    $("body").on("submit", "form.one-time-submit", function () {
        $(this).submit(function () {
            return false;
        });
        $(this).find("input[type='submit']")
            .attr("disabled", "disabled")
            .addClass("processing");
        return true;
    }).on('click', '.js-credential-details', function(e) {
        e.preventDefault();
        e.stopPropagation();

        $('#js-credential-details-modal').removeClass('hide').fadeIn();

        return false;
    }).on('click','#close-btn' ,function() {
        $('.modal-overlay').fadeOut();
    });
});

function validationOnlyNum(input) {
    // var allowCh = input.value.replace(/[^\d]/g, ''); // дозволити вводити тільки числа
    // input.value = allowCh; // прописуємо в інпут нове значення
}

function addError($element) {
    $element.parent('.field-error-wrapper')
        .addClass('has-error');
}

function removeError($element) {
    $element.parent('.field-error-wrapper')
        .removeClass('has-error');
}

function scrollToExchangeWrapper() {
    var wrapsHeight = $('.exchange-wrapper').offset().top - 50;
    $('body, html').animate({scrollTop: wrapsHeight}, 800);
}

function setRememberMe(value) {
    $.post('/auth/enable-auto-login', {rememberMe: value}, function(response) {
        if (response.result) {
            $('.modal-overlay').fadeOut();
        }
    }, 'json');
}

// Cookies-Strip
$(document).on('click', '#cookies-ok', function() {
    localStorage.setItem('cookies-ok', 'true');
    $('.cookies-strip').fadeOut();
    return false;
});

$(window).on('load', function(){
    if (localStorage.getItem('cookies-ok') == null){
        $('.cookies-strip').css('display', 'block');
    }
});
//close modal window with iframe in credential details
window.addEventListener("message", function(event) {
    if (event.data === 'closeButtonClick') {
        $('#js-credential-details-modal').fadeOut();
    }
}, false);
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
var normalize = (s) => {
    let x = String(s) || '';
    return x.replace(/^[\s\xa0]+|[\s\xa0]+$/g, '');
};

var check = (s) => {

    if (s.length < 26 || s.length > 35) {
        return false;
    }

    let re = /^[A-Z0-9]+$/i;
    if (!re.test(s)) {
        return false;
    }

    return true;
};
