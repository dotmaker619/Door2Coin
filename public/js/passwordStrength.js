jQuery(document).ready(function ($) {
    'use strict';

    var $passwordInput = $('.inputpass');
    var minPasswordLength = 6;
    var maxPasswordLength = 20;
    var passwordStrength;
    var $passwordBox = $('#password-strength').find('.progress');

    calculatePasswordStrength($passwordInput.val().length);

    $passwordInput.on('keyup', function() {
        if ($(this).hasClass('password-strength-meter')) {
            calculatePasswordStrength($(this).val().length);
        }
    });

    function calculatePasswordStrength(passwordLength) {
        if (passwordLength > maxPasswordLength) {
            passwordStrength = 100;
        } else if (passwordLength < minPasswordLength) {
            passwordStrength = 0;
        } else {
            passwordStrength = (passwordLength - minPasswordLength + 1) * 100 / (maxPasswordLength - minPasswordLength + 1);
        }

        if (passwordStrength <= 30) {
            $passwordBox.removeClass('back-yellow back-green');
            $passwordBox.addClass('back-red');
        } else if (passwordStrength > 30 && passwordStrength < 80) {
            $passwordBox.removeClass('back-red back-green');
            $passwordBox.addClass('back-yellow');
        } else {
            $passwordBox.removeClass('back-red back-yellow');
            $passwordBox.addClass('back-green');
        }

        $passwordBox.css('width', passwordStrength + '%');
    }


});
