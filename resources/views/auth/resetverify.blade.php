@extends('layouts.app')

@section('content')
    <div class="wrapper-form">
        <main id="js_reset-password" class="content login-wrapper forgot-wrapper reset-password active">
            <div class="login-inner shadow">
                <div class="left to-left">
                    <div>
                        <h2>Return to log in</h2>
                        <a class="btn forms-switcher" data-show-form="login">Log in</a> </div>
                </div>
                <div class="right to-right">
                    <h1>Verification</h1>
                    <h2 style="margin-bottom:20px;">Please check your email inbox and spam also.</h2>
                    <p>Enter Verification Code</p>
                    <form class="flex flex-wrap contact-padd" action="{{route("auth.postresetverify")}}" method="post">
                        {{ csrf_field() }}
{{--                        @if(\Session::has('error'))--}}
{{--                            <div class="alert">--}}
{{--                                <span class="closebtn">&times;</span>--}}
{{--                                {!! \Session::get('error') !!}--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        @if(\Session::has('errors'))
                            <div class="alert">
                                <span class="closebtn">&times;</span>
                                {!! \Session::get('errors') !!}
                            </div>
                        @endif
                        <div class="form-align-items">
                            <div class="form-field-wrapper">
                                <div class="field-error-wrapper field-resetpasswordform-email required">
                                    <input type="email" id="resetpasswordform-email" class="order-form-field" name="resetemail" size="40" title="Email" required="" aria-required="true" hidden>
                                    <input type="text" id="resetpasswordform-code" class="order-form-field" name="verifycode" size="40" title="Email" required="" aria-required="true">
                                    <div class="error-message"></div>
                                </div> </div>
                        </div>
                        <input class="contact-submit btn" type="submit" id="login" value="Verify">
                    </form> </div>
            </div>
        </main>
    </div>
    <div id="preloader" style="display: none;">
        <div class="timer">
            <div class="center"></div>
            <div class="short"></div>
            <div class="long"></div>
        </div>
    </div>
@endsection

@section('moreScript')
    <script>
        window.GLOBALS = window.GLOBALS ? window.GLOBALS : {};
        window.GLOBALS.formType = 'login';

        $('#resetpasswordform-email').val(window.localStorage.getItem('resetemail'));
    </script>
@endsection

@section('afterScript')
    <script>
        $ = jQuery;
        $(document).ready(function(){

            $('select, textarea, #currencyAmount, #cryptoWalletField').focus(function (e) {
                $(this).prev().css({"background-color": "#F6F9FE", "color": "#4441D4", "border-color": "#4441D4"});
            });
            $('select, textarea, #currencyAmount, #cryptoWalletField').blur(function (e) {
                $(this).prev().css({"background-color": "#F6F9FE", "color": "rgba(88, 96, 137, 0.3)", "border-color": "rgba(88, 96, 137, 0.3)"});
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
            $('.clear-amount').on('click', function() {
                $('#currencyAmount').val('0');
            });

        });

    </script>
@endsection



