@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <main class="content">

        <div class="login-inner edit-wallet-address">
            <div class="right to-left inner-wrapper-medium faq-main-wrapper">
                <h1 class="" style="padding-left: 50px;">
                    Edit Wallet Address </h1>
                @if(\Session::has('success'))
                    <div class="alert success" id="success-alert">
                        <span class="closebtn">&times;</span>
                        {!! \Session::get('success') !!}
                    </div>
                @endif
                <form class="editwallet-form" action="{{ route('posteditwallet') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-field-tab" >

                        <div id="wallet_list">
                            <div class="form-align-items" id="wallet_primary">
                                <div class="form-field-wrapper type-input">
                                    <div
                                        class="field-error-wrapper field-registrationform-firstname required has-success">
                                        <label class="control-label" for="registrationform-firstname"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Type</label>
                                        <input type="text" id="registrationform-firstname" class="order-form-field"
                                               name="type[]" placeholder="Type"
                                               value=""
                                               aria-required="true" aria-invalid="false">
                                        <div class="error-message"></div>
                                    </div>
                                </div>
                                <div class="form-field-wrapper">
                                    <div
                                        class="field-error-wrapper field-registrationform-firstname required has-success">
                                        <label class="control-label" for="registrationform-firstname"
                                               style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Wallet
                                            Address</label>
                                        <input type="text" id="registrationform-firstname" class="wallet-address-input order-form-field"
                                               name="address[]" placeholder="Wallet Address"
                                               value=""
                                               aria-required="true" aria-invalid="false">

                                        <div class="error-message">
                                            <span>The Wallet Address is Invalid.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="button-list">
                                    <div class="add-field">
                                        <button class="wallet-remove btn">Delete</button>
                                    </div>
                                    <div class="add-fields">
                                    </div>
                                </div>
                            </div>
                            @foreach($addresses as $data)
                                <div class="form-align-items  wallet-list">
                                    <div class="form-field-wrapper type-input">
                                        <div
                                            class="field-error-wrapper field-registrationform-firstname required has-success">
                                            <label class="control-label" for="registrationform-firstname"
                                                   style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Type</label>
                                            <input type="text" id="registrationform-firstname" class="order-form-field"
                                                   name="type[]" placeholder="Type"
                                                   value="{{$data->type}}"
                                                   aria-required="true" aria-invalid="false" required>
                                            <div class="error-message"></div>
                                        </div>
                                    </div>
                                    <div class="form-field-wrapper">
                                        <div
                                            class="field-error-wrapper field-registrationform-firstname required has-success">
                                            <label class="control-label" for="registrationform-firstname"
                                                   style="background-color: rgb(246, 249, 254); color: rgba(88, 96, 137, 0.3);">Wallet
                                                Address</label>
                                            <input type="text" id="registrationform-firstname" class="wallet-address-input order-form-field"
                                                   name="address[]" placeholder="Wallet Address"
                                                   value="{{$data->wallet_address}}"
                                                   aria-required="true" aria-invalid="false" required>

                                            <div class="error-message">
                                                <span>The Wallet Address is Invalid.</span>
                                            </div>
                                        </div>
                                    </div>
                                   <div class="button-list">
                                       <div class="add-field">
                                           <button class="wallet-remove btn">Delete</button>
                                       </div>
                                       <div class="add-fields">
                                           <a href="{{route('dashboard.index').'?wallet_id='.$data->id}}" class="wallet-removes btn">Buy to this Address</a>
                                       </div>
                                   </div>

                                </div>
                            @endforeach
                        </div>
                        <div class="form-align-items wallet-buttons">
                            <button class="add-more btn">Add More</button>
                            <input class="add-mores btn" type="submit" value="Save">
                        </div>
                    </div>

                </form>

                <div class="left left-on-mobile to-right"></div>
            </div>
        </div>


        <div class=" faq-section">
            <div class="inner-wrapper">
                <h1>TRANSACTIONS</h1>
                <p>Purchase Bitcoins 100% securely using any payment method and currency</p>
            </div>
            <img src="{{asset("assets/images/faq.svg")}}" alt="" class="faq-bg-img">
        </div>
        <div class="inner-wrapper-medium faq-main-wrapper">

            <div style="overflow-x:auto;">
                <table id="empTable" class="display dataTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Status</th>
                            <th>Rate</th>
                            <th>Crypto</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="mobile-wrapper"></div>
    </main>
@endsection
@section('afterScript')
    <script>
        $('.editwallet-form').submit(function(e) {

            // this code prevents form from actually being submitted
            e.preventDefault();
            e.returnValue = false;
            let flag = true;
            $('.wallet-address-input').each( function () {
                if($(this).prop('required')){
                    let value = $(this).val();
                    let v = normalize(value);
                    let result = check(v);
                    if (!result) {
                        $(this).next().show();
                        flag = false;
                    }
                }
            });

            if(flag) {
                $(this).off('submit');
                // actually submit the form
                $(this).submit();
            }

        });

        $(document).ready(function() {
            $("#wallet_primary").hide();
        });
        $(".add-more").on('click', function () {
            let temp =  $("#wallet_primary").clone().show();
            temp.addClass('wallet-list');
            temp.find(':input').prop('required', true);
            $("#wallet_list").append(temp);

        });
        $(document).on('click', '.wallet-remove', function () {
            if (confirm("Are you sure you want to delete this address?")) {
                $(this.parentNode.parentNode).remove();
            }
            return false;

        });
    </script>
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
    @if(\Session::has('success'))
        <script>
            $(document).ready( function () {
                $("#success-alert").delay(10000).fadeOut(500);
            });
        </script>
    @endif
    <script>
        $ = jQuery;
        $(document).ready(function () {
            $(".main-menu #m_transaction").addClass("active");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': '{{route('transaction.datatables')}}',
                'columns': [
                    { data: 'order_id' },
                    { data: 'transaction_id', orderable: false },

                    { data: 'amount' },
                    { data: 'currency_from' },
                    { data: 'transaction_status', searchable: false, orderable: false},
                    { data: 'rate', searchable: false, orderable: false},
                    { data: 'crypto', searchable: false, orderable: false},
                    { data: 'created' },
                ],
                "order":[[0, 'desc']]
            });
        });
    </script>
@endsection


