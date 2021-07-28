@extends('layouts.app')

@section('content')
    <div class="wrapper-form">
        <main id="js_sign-up" class="content login-wrapper registration-box sign-up active">
            <div class="login-inner">
                <div class="left left-on-desk to-right">
                </div>
                <div class="right to-left">
                    <h1 class="">
                        Edit Profile </h1>
                    @if(\Session::has('success'))
                        <div class="alert success" id="success-alert">
                            <span class="closebtn">&times;</span>
                            {!! \Session::get('success') !!}
                        </div>
                    @endif
                    <form class="editprofile-form" action="{{ route('posteditprofile') }}" method="post">
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
                                               value="{{Auth::user()->first_name}}"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
                                    </div>
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
                                               value="{{Auth::user()->last_name}}"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
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
                                               value="{{Auth::user()->email}}"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
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
                                               value="{{Auth::user()->country}}"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="form-item" style="display:none;">
                                        <input type="text" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" />
                                        <label for="country_selector_code">...and the selected country code will be updated here</label>
                                    </div>
                                </div>
                            </div>
                            <input class="contact-submit btn" type="submit" id="registration" value="Save">
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
        window.GLOBALS.formType = 'editprofile';
    </script>
    @if(\Session::has('success'))
        <script>
            $(document).ready( function () {
                $("#success-alert").delay(10000).fadeOut(500);
            });
        </script>
    @endif
    <script src="{{ asset('js/jquery.date-dropdowns.min.js') }}"></script>
    <script src="{{ asset('js/countrySelect.js') }}"></script>
@endsection

@section('afterScript')
    <script>
        $("#country_selector").countrySelect({
            preferredCountries: ['ca', 'gb', 'us']
        });
    </script>
@endsection



