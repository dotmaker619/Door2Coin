@extends('layouts.app')

@section('content')
    <div class="wrapper-form">
        <main id="js_sign-up" class="content login-wrapper registration-box sign-up active">
            <div class="login-inner">
                <div class="left left-on-desk to-right">
                </div>
                <div class="right to-left">
                    <h1 class="">
                        Change Password</h1>



                    <form class="changepassword-form" action="{{ route('postchangepassword') }}" method="post">
                        @if(\Session::has('error'))
                            <div class="alert">
                                <span class="closebtn">&times;</span>
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                        @if(\Session::has('success'))
                            <div class="alert success">
                                <span class="closebtn">&times;</span>
                                {!! \Session::get('success') !!}
                            </div>
                        @endif
                        {{ csrf_field() }}
                        <div class="form-field-tab">
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div class="field-error-wrapper field-oldregistrationform-password required">
                                        <label class="control-label" for="oldregistrationform-password"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Old Password</label>
                                        <input type="password" id="oldregistrationform-password"
                                               class="inputpass contact-input order-form-field password-strength-meter"
                                               name="oldpassword" size="40" title="Password"
                                               placeholder="Password" required="" aria-required="true"
                                               aria-invalid="true">
                                        <i class="material-icons fa fa-eye toggle-password"></i>
                                        <div class="error-message">Password should be between 6-20 characters and
                                            contain: Uppercase Letters, Lowercase Letters, Numbers or Symbols
                                        </div>
                                    </div>
                                    @if ($errors->has('oldpassword'))
                                        <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div class="field-error-wrapper field-registrationform-password required">
                                        <label class="control-label" for="registrationform-password"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">New Password</label>
                                        <input type="password" id="registrationform-password"
                                               class="inputpass contact-input order-form-field password-strength-meter"
                                               name="password" size="40" title="Password"
                                               placeholder="Password" required="" aria-required="true"
                                               aria-invalid="true">
                                        <i class="material-icons fa fa-eye toggle-password"></i>
                                        <div class="error-message">Password should be between 6-20 characters and
                                            contain: Uppercase Letters, Lowercase Letters, Numbers or Symbols
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div class="field-error-wrapper field-confirmform-password required">
                                        <label class="control-label" for="confirmform-password"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Confirm Password</label>
                                        <input type="password" id="confirmform-password"
                                               class="contact-input order-form-field password-strength-meter"
                                               name="password_confirmation" size="40" title="Password"
                                               placeholder="Confirm Password" required="" aria-required="true"
                                               aria-invalid="true">
                                        <i class="material-icons fa fa-eye toggle-password"></i>
                                        <div class="error-message">Password should be between 6-20 characters and
                                            contain: Uppercase Letters, Lowercase Letters, Numbers or Symbols
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-align-items">
                                <div class="form-field-wrapper progress-wrap">
                                    Password strength
                                    <div id="password-strength">
                                        <div class="progress back-green" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input class="contact-submit btn" type="submit" id="registration" value="Change Password">
                    </form>
                    <div class="left left-on-mobile to-right"></div>
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
        window.GLOBALS.formType = 'editprofile';
    </script>
    <script src="{{ asset('js/passwordStrength.js') }}"></script>
@endsection

@section('afterScript')
    <script>
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
        $("#country_selector").countrySelect({
            preferredCountries: ['ca', 'gb', 'us']
        });
    </script>
@endsection



