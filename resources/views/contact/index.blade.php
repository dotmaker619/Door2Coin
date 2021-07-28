@extends('layouts.app')

@section('content')
    <main class="content content_contact">
        <div class="flex main-wrapper contact-us-wrapper">
            <div class="contact-wrapper">
                <div class=" contact-us">
                    <div>
                        <h1>Contact Us</h1>
                        <p>We are here to assist you with any question you have</p>
                    </div>
                </div>
                <form id="contact" class="flex flex-wrap contact-padd" action="{{route('contact.send')}}" method="post">
                    {{ csrf_field() }}
                    <h2 class="form-header">Leave us a message and we will get back to you</h2>
                    <div class="form-align-items">
                        <div class="form-field-wrapper">
                            <div class="field-error-wrapper field-contactform-name required">
                                <label class="control-label" for="contactform-name"
                                       style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Full
                                    name</label>
                                <input type="text" id="contactform-name" class="contact-input order-form-field"
                                       name="fullname" size="40" required="" aria-required="true"
                                       aria-invalid="true">
                                <div class="error-message">Name cannot be blank.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-align-items">
                        <div class="form-field-wrapper">
                            <div class="field-error-wrapper field-contactform-email required">
                                <label class="control-label" for="contactform-email"
                                       style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Email</label>
                                <input type="email" id="contactform-email" class="contact-input order-form-field"
                                       name="email" size="40" required="" aria-required="true"
                                       aria-invalid="true">
                                <div class="error-message">Email cannot be blank.</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-align-items">
                        <div class="form-field-wrapper">
                            <div class="js-select select field-contactform-subject required has-success">
                                <label class="control-label" for="contactform-subject"
                                       style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3); border-color: rgba(88, 96, 137, 0.3);">Select
                                    a topic</label>
                                <select id="contactform-subject" class="contact-input order-form-field not-empty"
                                        name="subject" aria-required="true" aria-invalid="false" required>
                                    <option value="" selected="" disabled="" style="display:none;">Select a topic
                                    </option>
                                    <option class="nms" value="General question ">General question</option>
                                    <option class="nms" value="Registration verification question">Registration
                                        verification question
                                    </option>
                                    <option class="nms" value="Billing question">Billing question</option>
                                    <option class="nms" value="Technical support">Technical support</option>
                                </select>
                                <div class="error-message"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-align-items">
                        <div class="form-field-wrapper">
                            <div class="field-error-wrapper field-contactform-body required">
                                <label class="control-label" for="contactform-body"
                                       style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3); border-color: rgba(88, 96, 137, 0.3);">Write
                                    your message here</label>
                                <textarea id="contactform-body" class="contact-textarea order-form-field"
                                          name="message" aria-required="true" aria-invalid="true" required></textarea>
                                <div class="error-message">Body cannot be blank.</div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="g-recaptcha" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft"--}}
{{--                         data-sitekey="6Ld9W5QUAAAAAL0iEAIoS5y4GcT6wiqWopHymlUS">--}}
{{--                        <div class="grecaptcha-badge" data-style="bottomleft"--}}
{{--                             style="width: 256px; height: 60px; display: block; transition: left 0.3s ease 0s; position: fixed; bottom: 14px; left: -186px; box-shadow: gray 0px 0px 5px; border-radius: 2px; overflow: hidden;">--}}
{{--                            <div class="grecaptcha-logo">--}}
{{--                                <iframe title="reCAPTCHA" src="./Door2Coin_files/anchor.html" width="256" height="60"--}}
{{--                                        role="presentation" name="a-33rx5lmidsty" frameborder="0" scrolling="no"--}}
{{--                                        sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>--}}
{{--                            </div>--}}
{{--                            <div class="grecaptcha-error"></div>--}}
{{--                            <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response"--}}
{{--                                      style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>--}}
{{--                        </div>--}}
{{--                        <iframe __idm_frm__="5841" style="display: none;"--}}
{{--                                src="./CoinsXP_files/saved_resource.html"></iframe>--}}
{{--                    </div>--}}
                    <p>Our site is following all <a href="{{route('termsofservice')}}" target="_blank">Terms and Conditions </a><a href="{{route('privacynotice')}}" target="_blank">of
                            Door2Coin Privacy Notice</a>. By submitting this "Contact us" form you are accepting us to
                        process your data in order to be able to assist you. Please don't provide any sensitive
                        information such as health details etc. </p>
                    <input class="contact-submit btn" type="submit" value="Send message">
                </form>
            </div>
        </div>
        <div class="contact-footer shadow">
            <div class="half left">
                <div class="icon phone"></div>
                <p class="strong">
                    Contact us via e-mail: <a href="mailto:support@door2coin.com">support@door2coin.com</a>
                </p>
            </div>
            <div class="half right">
                <div class="icon time"></div>
                <p class="strong">
                    We work: <b class="work-time">Monday — Friday from 10AM to 5PM (GMT+2)</b>
                </p>
            </div>
        </div>
    </main>

@endsection
@section('afterScript')
    <script>function onSubmit(token) {
            document.getElementById('contact').submit();
        }</script>
{{--    <script>jQuery(function ($) {--}}
{{--            jQuery('#contact').on('beforeSubmit', function () {--}}
{{--                grecaptcha.execute();--}}
{{--                return false;--}}
{{--            })--}}
{{--        });</script>--}}


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
            $('.clear-amount').on('click', function () {
                $('#currencyAmount').val('0');
            });

        });

    </script>
    <script>
        $ = jQuery;
        $(document).ready(function () {
            $(".main-menu #m_contact").addClass("active");
        });
    </script>
@endsection


