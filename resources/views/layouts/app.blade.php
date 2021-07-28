<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Door2Coin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="format-detection" content="telephone=no">

    <link href="{{ asset('css/icon.css') }}"  rel="stylesheet">

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="icon"
          type="image/png"
          href="{{ asset('assets/images/logo.png') }}">
    <link href="{{ asset('css/intlTelInput.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/countrySelect.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" type='text/css'>
    <script>
        var GLOBALS = {
            country: 'RU'
        };

    </script>

</head>
<body>

<section class="body">
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')
</section>

<script>
    GLOBALS.currencySigns = {"1":"$","2":"€","3":"£","4":"RM","5":"R"};
</script>

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/jquery.ui.touch-punch.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>


@yield('moreScript')
@yield('afterScript')

</body></html>
