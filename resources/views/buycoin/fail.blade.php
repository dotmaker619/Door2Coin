@extends('layouts.app')

@section('content')
    <main class="content">
        <div class=" faq-section">
            <div class="inner-wrapper">
                <h1>Failed</h1>
                <p></p>
            </div>
            <img src="{{asset("assets/images/faq.svg")}}" alt="" class="faq-bg-img">
        </div>
        <div class="mobile-wrapper"></div>
    </main>
@endsection

@section('afterScript')

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
            $('.question-item').click(function (e) {
                $(this).toggleClass('active-question');
            });
            $('.clear-amount').on('click', function () {
                $('#currencyAmount').val('0');
            });

        });

    </script>
@endsection

