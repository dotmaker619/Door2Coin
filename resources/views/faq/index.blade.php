@extends('layouts.app')

@section('content')
    <main class="content">
        <div class=" faq-section">
            <div class="inner-wrapper">
                <h1>FAQ</h1>
                <p>Purchase Bitcoins 100% securely using any payment method and currency</p>
            </div>
            <img src="{{asset("assets/images/faq.svg")}}" alt="" class="faq-bg-img">
        </div>
        <div class="inner-wrapper-medium faq-main-wrapper">

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="first_tab">

                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>What is bitcoin?</span>
                        </h4>
                        <div class="question-text">
                            <p>Bitcoin is a form of digital currency, created and held electronically. It is the first decentralized peer-to-peer payment network that is powered by its users without having a central authority or middlemen involved.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>How long does it take for Door2Coin to send my bitcoins once I’ve paid?</span>
                        </h4>
                        <div class="question-text">
                            <p>Door2Coin sends Bitcoins immediately after the client’s payment details have been confirmed and authenticated. Delays might occur as a result of purchasing outside of business hours (GMT) or regardless of hours of operation.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>What methods of payment does Door2Coin offer?</span>
                        </h4>
                        <div class="question-text">
                            <p>At Door2Coin, you can purchase Bitcoins with your choice of credit/debit card or by using an alternative payment method.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>What if I want to buy more/less coins than the amounts offered?</span>
                        </h4>
                        <div class="question-text">
                            <p>If you would like to buy different amounts, please use the “Slider” (the price calculator) located at the bottom of the homepage or the input for entering the desired sum.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Can I cancel a Bitcoin transaction after it was processed?</span>
                        </h4>
                        <div class="question-text">
                            <p>Bitcoin transactions are irreversible once they been broadcasted to the blockchain (regardless if the order is processed or confirmed). Therefore, even if you send a transaction to an invalid address or confirm a transaction by mistake, it cannot be reversed.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>How can I prove that a bitcoin transfer was made?</span>
                        </h4>
                        <div class="question-text">
                            <p>By checking http://blockchain.info/address/YOURADDRESS, you will be able to view the records of the coins you’ve purchased, which were sent to or from your address.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Are my payment details saved in your system?</span>
                        </h4>
                        <div class="question-text">
                            <p>Door2Coin keeps the regular BIN (meaning saved are first 6 and last 4 digits of the card number). Your card details will be used to process payment transactions through our system to your E-wallet as well as to help us verify your registration, comply with our legal and regulatory obligations, and help us prevent and detect fraud and crime.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>What currencies does Door2Coin accept?</span>
                        </h4>
                        <div class="question-text">
                            <p>Door2Coin accepts all types of currencies, so you’ll be able to purchase Bitcoins with your local currency using your credit card or alternative payment method. Since the pricing in the site is displayed with Euros, Door2Coin will be converting your transaction into Euros. Conversion fees may apply.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Why do I see a charge on my bank account but did not receive the coins yet?</span>
                        </h4>
                        <div class="question-text">
                            <p>If your payment hasn’t been approved yet, the charge you see on your account is most likely an authorization check, which is created immediately after a payment attempt was made. This is necessary to “save” the transaction amount in case the payment is approved. In the event that the payment is declined, the charge will automatically void within 48 hours, depending on your bank’s policy.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Is Bitcoin anonymous?</span>
                        </h4>
                        <div class="question-text">
                            <p>Bitcoin is often described as an anonymous payment network, but in reality, bitcoin is pseudonymous: all bitcoin transactions are public and traceable in the blockchain but without an individual's identity visibly attached to those transactions.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Does Door2Coin facilitate trades between buyers and sellers?</span>
                        </h4>
                        <div class="question-text">
                            <p>Absolutely not. Any transaction that is made through the site is solely between you and Door2Coin. We purchase the Bitcoins for you in real-time from our exchange vendor once the transaction is approved.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>How do I contact Door2Coin customer support?</span>
                        </h4>
                        <div class="question-text">
                            <p>If you have not found what you were looking for in our FAQ section, feel free to communicate with our customer support team, available through our <a href="{{route("contact.index")}}" rel="nofollow">contact us</a> page.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Does Door2Coin support other Cryptocurrencies besides Bitcoin?</span>
                        </h4>
                        <div class="question-text">
                            <p>You can only purchase Bitcoins with your Door2Coin registration. As Door2Coin solely works with BTC, any transaction from other cryptocurrencies such as Bitcoin Cash, Ethereum, Litecoin, Ripple, etc., are not supported.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Where can I get a Bitcoin wallet?</span>
                        </h4>
                        <div class="question-text">
                            <p>In order to download your own Bitcoin wallet for free, we suggest that you visit <a href="https://blockchain.info/ru/wallet/" target="_blank">www.blockchain.info/wallet</a> and follow the on-screen instructions.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>How do I change the email address associated with my Door2Coin registration?</span>
                        </h4>
                        <div class="question-text">
                            <p>If you'd like to change the email address associated with your registration, please contact us and we'll help you change it. If your primary email address will change, make sure to let us know before you no longer have access to it.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>How does Door2Coin determine the Bitcoin price?</span>
                        </h4>
                        <div class="question-text">
                            <p>Door2Coin uses market rates from several different exchanges in order to calculate the price of Bitcoin.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Why does Door2Coin ask for my personal information?</span>
                        </h4>
                        <div class="question-text">
                            <p>Door2Coin aims to provide global banking services for bitcoin, but is not assigned to provide an anonymous service. By providing some basic information, our users will help Door2Coin and the bitcoin community to create equally convenient security and consumer protection and ultimately bring more trust to Bitcoin.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>What are the processing fees?</span>
                        </h4>
                        <div class="question-text">
                            <p>Processing fees are necessary charges that customers need to pay in order to perform a transaction. They represent the amount of money that&nbsp;Door2Coin is charged by a bank&nbsp;or a service for an incoming wire, direct debit or cash deposit. These fees can be received by Door2Coin through the fulfillment by the customer during payment. In some instances, Door2Coin may choose to reduce or simply not charge the processing fee for some operations during a certain period of time, or the fee may be eliminated if it is no longer charged to Door2Coin.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Are there any restricted states where I can’t purchase Bitcoin from?</span>
                        </h4>
                        <div class="question-text">
                            <p>Due to regulation limitations, Door2Coin is currently prohibited from operating in various countries. Please refer to section 6.4 in our <a href="{{route('termsofservice')}}" target="_blank">Terms of Service</a> for the complete list.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>I’ve paid, but my order was not released. What should I do?</span>
                        </h4>
                        <div class="question-text">
                            <p>Your orders are released as soon as there’s a confirmation that your payment was successfully received. If you've paid but are still waiting, there is nothing to worry about, your Bitcoin is waiting for the funds to arrive in their bank. There can also be delays if you are transferring between different banks or it's a holiday or weekend. But don't worry, while your order is opened we are holding the funds in your name.</p>
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Government issued ID</span>
                        </h4>
                        <div class="question-text">
                            <p>A coloured copy of a government issued ID (passport, ID Card or Driver’s License both sides). Must be valid and not expiring in less than 3 months.</p>
                            <img src="{{asset("assets/images/id.png")}}" class="verification-img" alt="Passport or ID card">
                        </div>
                    </div>
                    <div class="question-item">
                        <h4 class="question-title">
                            <span class="num"><i class="icon-back"></i></span>
                            <span>Proof of address</span>
                        </h4>
                        <div class="question-text">
                            <p>Bank statement showing at least 5 transactions or a utility bill (such as electricity, gas, water or landline/internet bill/TV license).</p>
                            <p>This document should include your full name and address and should not be older than 3 months. For the convenience of our customers, you may submit the necessary documentation directly. We accept the following formats: jpg, jpeg, tif, png, gif, pdf, and doc. We do not accept compressed formats or links. Please ensure the documents are clear and legible.</p>
                            <p>For the convenience of our customers, you may submit the necessary documentation directly. We accept the following formats: jpg, jpeg, tif, png, gif, pdf, and doc. We do not accept compressed formats or links. Please ensure the documents are clear and legible.</p>
                            <p>Please send the copies of your documents to <a href="mailto:support@door2coin.com">support@door2coin.com</a></p>
                        </div>
                    </div>
                </div>
            </div> </div>
        <div class="mobile-wrapper"></div>
    </main>
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
    <script>
        $ = jQuery;
        $(document).ready(function () {
            $(".main-menu #m_faq").addClass("active");
        });
    </script>
@endsection


