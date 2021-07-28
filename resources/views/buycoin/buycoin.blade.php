@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="wrapper-form">
        <main id="js_sign-up" class="content login-wrapper registration-box sign-up active">
            <div class="login-inner">
                <div class="left left-on-desk to-right">
                </div>
                <div class="right to-left">
                    <h1>Buy Bitcoin</h1>
                    <form method="post" action="https://wallet.advcash.com/sci/" id="buycoin_form">
                        <input type="hidden" name="ac_account_email" value="alex@minersold.com" />
                        <input type="hidden" name="ac_sci_name" value="Door2Coin.com" />
                        <div class="form-field-tab">
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div
                                        class="field-error-wrapper field-registrationform-amount required has-success">
                                        <label class="control-label" for="registrationform-amount"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Amount</label>
                                        <input type="number" id="registrationform-amount" class="order-form-field"
                                               name="ac_amount" placeholder="Amount"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div
                                        class="field-error-wrapper field-registrationform-currency required has-success">
                                        <label class="control-label" for="registrationform-currency"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Currency</label>
                                        <input type="text" id="registrationform-currency" class="order-form-field"
                                               name="ac_currency" placeholder="Currency" value="USD"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-align-items">
                                <div class="form-field-wrapper">
                                    <div
                                        class="field-error-wrapper field-registrationform-comment required has-success">
                                        <label class="control-label" for="registrationform-comment"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Comment</label>
                                        <input type="text" id="registrationform-comment" class="order-form-field"
                                               name="ac_comments" placeholder="Comment"
                                               aria-required="true" aria-invalid="false" required>
                                        <div class="error-message"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="ac_order_id" value="123456789" />
                        <input type="hidden" name="ac_sign" value="8d8780ed5bd0295285eabd22b0ca8b01ff9393c61cf4777a0975acdd547d9dea" />
                        <!-- Optional Fields -->
                        <input type="hidden" name="ac_success_url" value="http://www.door2coin.com/buycoin/success" />
                        <input type="hidden" name="ac_success_url_method" value="GET" />
                        <input type="hidden" name="ac_fail_url" value="http://www.door2coin.com/buycoin/fail" />
                        <input type="hidden" name="ac_fail_url_method" value="GET" />
                        <input type="hidden" name="ac_status_url" value="http://www.door2coin.com/buycoin/status" />
                        <input type="hidden" name="ac_status_url_method" value="GET" />
                        <input class="contact-submit btn" type="submit" id="buycoin" value="Buy Bitcoin">
                    </form>
                </div>
            </div>
        </main>
    </div>
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
        });

    </script>
    <script>
        $ = jQuery;
        $(document).ready(function () {
            $(".main-menu #m_buycoin").addClass("active");
            $('#registrationform-amount').val(parseFloat(window.localStorage.getItem('amount')) );
        });
        $('#buycoin_form').submit(function(e) {

            // this code prevents form from actually being submitted
            e.preventDefault();
            e.returnValue = false;


            // some validation code here: if valid, add podkres1 class
            let $form = $(this);
            $.ajax({
                type: 'post',
                url: '/getTransactionId',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ac_amount: $('#registrationform-amount').val(),
                    ac_currency: $('#registrationform-currency').val(),
                    ac_comments: $('#registrationform-comment').val()
                },
                context: $form, // context will be "this" in your handlers
                success: function(response) { // your success handler
                    console.log(response.data);
                    $('input[name="ac_success_url"]').val('http://www.door2coin.com/buycoin/success?id=' + response.data.id);
                    $('input[name="ac_fail_url"]').val('http://www.door2coin.com/buycoin/fail?id=' + response.data.id);
                    $('input[name="ac_status_url"]').val('http://www.door2coin.com/buycoin/status?id=' + response.data.id);
                    $('input[name="ac_order_id"]').val(response.data.order_id);
                },
                error: function() { // your error handler
                },
                complete: function() {
                    // make sure that you are no longer handling the submit event; clear handler

                    this.off('submit');
                    // // actually submit the form
                    this.submit();
                }
            });
        });
    </script>
@endsection


