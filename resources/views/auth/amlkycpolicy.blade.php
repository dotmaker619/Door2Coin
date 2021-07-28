@extends('layouts.app')

@section('content')
    <section class="inner-wrapper pad-inner-space">
        <h1 class="page-title">ANTI-MONEY LAUNDERING &amp; KYC POLICY</h1>
        <div class="default-text-style">
            <p><strong>1485261 Ontario Inc</strong> takes into consideration the Legal standards for Money Laundering and other criminal activities.</p>
            <p>Who May Use the Services</p>
            <ul>
                <li>You must not use the Services under any circumstances if you are under the age of 18 years old.</li>
                <li>o	We may on registration of your account with us and at any time thereafter request that you provide us with your personal information, including but not limited to, your name, address, telephone number, e-mail address and date of birth. We will verify your details, by requesting certain documents from you. These documents may typically include a government-issued passport/identity card, proof of address such as a utility bill, also we may request you to provide us with a proof of your payment method. We may request that copies of such documents are notarized at your own expense, meaning that the documents are stamped and attested by a Public Notary. Should the documents fail our internal security checks – for example, if we suspect that they have been tampered with, or are in any way proved to mislead or misrepresent – we shall be under no obligation to accept such documents as valid, and under no obligation to provide feedback on the exact nature of our findings with regards to these documents. In addition, we may request that you attend a video call to verify your identity.</li>
                <li>We may also perform further background checks on you and request any relevant documentation from you for any reason.</li>
                <li>You may not use the Services of the Website if you are located or are a resident of the Afghanistan, Algeria, Bahamas, Bangladesh, Bolivia, Central Africa, Congo, Cuba, Ecuador, Egypt, Ghana, Guyana, Iran, Iraq, Lebanon, Libya, Mali, Mongolia, Morocco, Myanmar, Nepal, North Korea (PRK), Pakistan, Palestine, Qatar, Somalia, South Sudan, Sudan, Syria, Trinidad & Tobago, Turkey, UAE, USA,Venezuela, Western Sahara,Yemen, Zimbabwe ("Restricted Territories"). The Restricted Territories list may change from time to time for reasons which include but are not limited to licensing requirements and any other legal and regulatory changes.</li>
            </ul>
            <p><strong>1485261 Ontario Inc</strong> has policies and procedures in place to prevent the involvement or misuse of money laundering activities. Prior to accepting new clients and allowing them to make transactions, the following documents shall be obtained for the verification of clients’ identity <strong>1485261 Ontario Inc</strong> shall be responsible for the collection of all information and documentation of any potential client in order for the Company to accept the said client.</p>
            <p>These procedures include:</p>
            <ul>
                <li>obtaining appropriate evidence of client identity</li>
                <li>maintaining adequate records of identification information</li>
                <li>determining that clients are not known or suspected terrorists by checking their names against lists of known or suspected terrorists</li>
                <li>informing clients that the information they provide may be used to verify their identity</li>
                <li>maintains records of client transactions</li>
            </ul>
            <p>Money laundering occurs when funds from an illegal/criminal activity are moved through the financial system in such a way as to make it appear that the funds have come from legitimate sources.</p>
            <p>There are three stages involved in money laundering; placement, layering, and integration.</p>
            <ul>
                <li>firstly, cash or cash equivalents are placed into the financial system</li>
                <li>secondly, money is transferred or moved to other accounts (e.g. futures accounts) through a series of financial transactions designed to obscure the origin of the money</li>
                <li>And finally, the funds are re-introduced into the economy so that the funds appear to have come from legitimate sources (e.g. closing a futures account and transferring the funds to a bank account).<br>
                    In order to avoid any money laundering suspects cases, we demand that clients declare on the source of the funds that are used while using <strong>1485261 Ontario Inc</strong> Services</li>
            </ul>
            <p>All the guidelines mentioned above have been taken into consideration to protect <strong>1485261 Ontario Inc</strong> and its clients.</p> </div>
    </section>
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



