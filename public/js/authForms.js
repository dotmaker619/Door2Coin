jQuery(document).ready(function ($) {
    'use strict';

    var formType = window.GLOBALS.formType;
    var formUrls = (window.GLOBALS.formUrls) ? JSON.parse(window.GLOBALS.formUrls) : {};

    switchForms(formType);

    $('.forms-switcher').on('click', function(){
        formType = $(this).data('show-form');
        switchForms(formType);
    });

    var form_elem = $('main.login-wrapper'),
        signUp = $('#js_sign-up'),
        resetPassword = $('#js_reset-password'),
        login = $('#js_login');

    if ($(window).width() >= 700) {
        // maxHeight();
    }

    window.addEventListener("orientationchange", function() {
        var height_signUp = signUp.innerHeight();
        form_elem.find('.login-inner').css('height', height_signUp + 'px');
    }, false);



    function animateAllForms() {
        var form_left_elem = $('main.login-wrapper').find('.left'),
            form_right_elem = $('main.login-wrapper').find('.right'),
            form_left_elem_btn = $('main.login-wrapper').find('.btn');

        if(!form_left_elem.hasClass('to-left') && form_left_elem.hasClass('to-right')) {
            form_left_elem.addClass('to-left');
            form_left_elem.removeClass('to-right');
            form_right_elem.addClass('to-right');
            form_right_elem.removeClass('to-left');
        } else {
            form_left_elem.addClass('to-right');
            form_left_elem.removeClass('to-left');
            form_right_elem.addClass('to-left');
            form_right_elem.removeClass('to-right');
        }

        setTimeout(function () {
            form_left_elem_btn.addClass('play');
        }, 300);
        setTimeout(function () {
            form_left_elem_btn.removeClass('play');
        }, 700);
    }

    function switchForms(showFormType) {
        animateAllForms();

        setTimeout(function () {
            $('main.login-wrapper').removeClass('active');
            $('main.' + showFormType).addClass('active');
        }, 450);

        if(!($('.wrapper-form.join-us').length)) {
            window.history.pushState('', '', getPageUrl(showFormType));
        }

    }

    function getPageUrl(formType) {
        return formUrls.hasOwnProperty(formType) ? formUrls[formType] : '';
    }
});
