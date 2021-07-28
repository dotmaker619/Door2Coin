@extends('layouts.app')

@section('content')
    <div class="wrapper-form">
        <main id="js_sign-up" class="content login-wrapper registration-box sign-up active">
            <div class="login-inner">
                <div class="left left-on-desk to-right">
                </div>
                <div class="right to-left">
                    <h1 class="">
                        Registration to Door2Coin.com </h1>

                    <form id="w0" class="sign-up-form" action="{{ route('auth.register') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-field-tab">
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div
                                        class="field-error-wrapper field-registrationform-firstname required has-success">
                                        <label class="control-label" for="registrationform-firstname"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">First
                                            Name</label>
                                        <input type="text" id="registrationform-firstname" class="order-form-field"
                                               name="first_name" placeholder="First Name"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
                                    </div>
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div
                                        class="field-error-wrapper field-registrationform-lastname required has-success">
                                        <label class="control-label" for="registrationform-lastname"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Last
                                            Name</label>
                                        <input type="text" id="registrationform-lastname" class="order-form-field"
                                               name="last_name" placeholder="Last Name"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
                                    </div>
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div
                                        class="field-error-wrapper form-item field-registrationform-country required has-success">
                                        <label class="control-label" for="country_selector"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Country</label>
                                        <input type="text" id="country_selector" class="order-form-field"
                                               name="country" placeholder="Country"
                                               aria-required="true" aria-invalid="false">
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="form-item" style="display:none;">
                                        <input type="text" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" required />
                                        <label for="country_selector_code">...and the selected country code will be updated here</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div class="field-error-wrapper field-registrationform-email required has-success">
                                        <label class="control-label" for="registrationform-email"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Email
                                            address</label>
                                        <input type="text" id="registrationform-email" class="order-form-field"
                                               name="email" placeholder="Email address"
                                               aria-required="true" aria-invalid="false">
                                        <div class="error-message"></div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div class="field-error-wrapper field-registrationform-password required">
                                        <label class="control-label" for="registrationform-password"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Password</label>
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
                            <div class="checkbox-set">
                                <div class="checkbox">
                                    <div
                                        class="field-error-wrapper field-registrationform-confirmsendkyc required has-success">
                                        <input type="hidden" name="RegistrationForm[confirmSendKYC]" value="0"><input
                                            type="checkbox" id="registrationform-confirmsendkyc"
                                            name="RegistrationForm[confirmSendKYC]" value="1"
                                            aria-invalid="false" required><label class="control-label"
                                                                        for="registrationform-confirmsendkyc">I accept
                                            the <a href="{{route('amlkycpolicy')}}" rel="nofollow"
                                                   target="_blank">AML&amp;KYC Policy</a> and would like to send the KYC
                                            verification documents within the next 72 hours.</label>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <div
                                        class="field-error-wrapper field-registrationform-confirmopenaccount required has-success">
                                        <input type="hidden" name="RegistrationForm[confirmOpenAccount]"
                                               value="0"><input type="checkbox" id="registrationform-confirmopenaccount"
                                                                name="RegistrationForm[confirmOpenAccount]" value="1"
                                                                aria-invalid="false" required><label class="control-label"
                                                                                            for="registrationform-confirmopenaccount">I
                                            confirm to register with door2coin.com</label>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <div
                                        class="field-error-wrapper field-registrationform-confirmterms required has-success">
                                        <input type="hidden" name="RegistrationForm[confirmTerms]" value="0"><input
                                            type="checkbox" id="registrationform-confirmterms"
                                            name="RegistrationForm[confirmTerms]" value="1" aria-invalid="false" required><label
                                            class="control-label" for="registrationform-confirmterms">I accept <a
                                                href="{{route('termsofservice')}}" rel="nofollow"
                                                target="_blank">Terms of Service</a> and <a
                                                href="{{route('privacynotice')}}" rel="nofollow"
                                                target="_blank">Privacy Notice</a></label>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <div
                                        class="field-error-wrapper field-registrationform-confirmisnotpep required has-success">
                                        <input type="hidden" name="RegistrationForm[confirmIsNotPEP]" value="0"><input
                                            type="checkbox" id="registrationform-confirmisnotpep"
                                            name="RegistrationForm[confirmIsNotPEP]" value="1"
                                            aria-invalid="false" required><label class="control-label"
                                                                        for="registrationform-confirmisnotpep">I confirm
                                            that I do not have a criminal history and I'm not a Politically Exposed
                                            Person (PEP)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class="contact-submit btn" type="submit" id="registration" value="Sign up">
                        <div class="bottom-login">
                            <p>Already have an account?</p>
                            <p>
                                <a href="{{ route('auth.signin') }}" class="btn login-signup-btn" data-show-form="login">Login</a></p>
                        </div>
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
        window.GLOBALS.formType = 'sign-up';
    </script>
    <script src="{{ asset('js/passwordStrength.js') }}"></script>
    <script src="{{ asset('js/authForms.js') }}"></script>

    <script src="{{ asset('js/jquery.date-dropdowns.min.js') }}"></script>
    <script src="{{ asset('js/countrySelect.js') }}"></script>
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



