@section('footer')
    <footer class="flex align-center">
        <div class="copyright">
            <div class="flex align-center justify-between footer-top">
                <a href="{{ route('dashboard.index') }}" class="link-logo third">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Door2Coin">
                </a>
                <div style="display: flex"><p class="partners-article">Accept Payment Methods:</p>
                    <p class="partners-img">
                        <img src="{{ asset('assets/images/visa_mastercard_footer.png') }}" alt="card_types">
                    </p>
                </div>
            </div>
            <div>
                <div align="justify">Copyright 2021 © All Rights Reserved. Door2Coin.com is owned and
                    operated by 1485261 Ontario Inc, Canada. 1485261 Ontario Inc aims to provide the services of
                    selling virtual currencies to individuals around the world. Our users are able to easily purchase and securely
                    store bitcoins with a swipe of a card. Please read our “<a href="{{route('privacynotice')}}"
                                                                               rel="nofollow" target="_blank">Privacy Notice</a>”, “<a
                        href="{{route('amlkycpolicy')}}" rel="nofollow" target="_blank">AML &amp; KYC Policy</a>” and “<a
                        href="{{route('termsofservice')}}" rel="nofollow" target="_blank">Terms of Service</a>” before deciding to
                    use our site. <b><u>Risk Warning</u></b>: The investment in virtual currencies, such as Bitcoin and others,
                    involves significant amount of risk and can lead to the loss of money over short or even long periods of
                    time. The investors in virtual currencies should expect prices to have large range fluctuations. The information
                    published on the website doesn’t guarantee that the investors in any virtual currency would not lose money. All prices and transactions are in Euro currency, therefore transactions from
                    clients from outside the EU will be converted to EUR. You may not use the Services or the Website if you
                    are located or are a resident of Afghanistan, Algeria, Bahamas, Bangladesh, Bolivia, Central Africa, Congo, Cuba, Ecuador, Egypt, Ghana, Guyana, Iran, Iraq, Lebanon, Libya, Mali, Mongolia, Morocco, Myanmar, Nepal, North Korea (PRK), Pakistan, Palestine, Qatar, Somalia, South Sudan, Sudan, Syria, Trinidad & Tobago, Turkey, UAE, USA,Venezuela, Western Sahara,Yemen, Zimbabwe (“<b>Restricted
                        Territories</b>”).
                </div>
            </div>
            <div class="flex align-between flex-colum-items partners-img-wrapper">
                <p class="partners-img">
                    <img src="{{ asset('assets/images/rapidssl_footer.png') }}" alt="rapid">
                </p>
                <p class="partners-img">
                    <img src="{{ asset('assets/images/comodossl_footer.png') }}" alt="comodo">
                </p>
            </div>
        </div>
    </footer>
@show

