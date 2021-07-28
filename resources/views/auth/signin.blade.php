@extends('layouts.app')

@section('content')
    <div class="wrapper-form">
        <main id="js_login" class="content login-wrapper login active">
            <div class="login-inner">
                <div class="right to-left">
                    <h1>Log in to door2coin.com</h1>
                    <form id="w2" class="flex flex-wrap contact-padd" action="{{route("auth.postlogin")}}" method="post">
                        {{ csrf_field() }}
                        @if(\Session::has('errors'))
                            <div class="alert">
                                <span class="closebtn">&times;</span>
                                {!! \Session::get('errors') !!}
                            </div>
                        @endif
                        <div class="form-align-items">
                            <div class="form-field-wrapper">
                                <div class="field-error-wrapper field-loginform-email required">
                                    <label class="control-label" for="loginform-email">Email address</label>
                                    <input type="text" id="loginform-email" class="order-form-field" name="email" size="40" title="Email" required="" aria-required="true">
                                    <div class="error-message"></div>
                                </div> </div>
                        </div>

                        <div class="form-align-items">
                            <div class="form-field-wrapper">
                                <div class="field-error-wrapper field-loginform-password required">
                                    <label class="control-label" for="loginform-password">Password</label>
                                    <input type="password" id="loginform-password" class="inputpass contact-input order-form-field" name="password" size="40" title="Password" required="" aria-required="true">
                                    <i class="material-icons fa fa-eye toggle-password"></i>
                                    <div class="error-message"></div>
                                </div> </div>
                        </div>
                        <div class="form-field-wrapper forgot">
                            <p>
                                Forgot password? <a id="js_forms-switcher" href="{{route("auth.resetpass")}}" class="forms-switcher" data-show-form="reset-password">Click here to recover</a> </p>
                        </div>

                        <input class="contact-submit btn" type="submit" value="Log in">
                        <div class="bottom-register">
                            <p>Don’t have an account yet?</p>
                            <a href="{{ route('auth.signup') }}" class="btn forms-switcher btn-mobile" data-show-form="sign-up">Sign Up</a>  </div></form>
                </div>
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
    </script>
@endsection

@section('afterScript')
    <script>
        $ = jQuery;
        $(document).ready(function(){
            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye-slash");
                if ( $(this).siblings( "input" ).attr("type") === "password") {
                    $(this).siblings( "input" ).attr("type", "text");
                    $(this).css('color', '#5a6471');
                } else {
                    $(this).siblings( "input" ).attr("type", "password");
                    $(this).css('color', '#a7b5c8');
                }
            });
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



