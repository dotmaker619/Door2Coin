@section('header')

    <header id="mainHeader" class="header-main header-bg flex justify-between">
        <div id="overlay" class=""></div>
        <nav class="mobile-menu">
            <div class="menu-container" id="menu-container">
                <div id="close">
                    <i class="material-icons"></i>
                </div>
                <ul class="main-menu">
                    @if (Auth::check())
                        <li>
                            <a id="m_transaction" href="{{ route('transaction.index') }}" class="nav-link">
                                Transactions </a>
                        </li>
                    @endif
                    <li>
                        <a id="m_buycoin" href="{{ route('dashboard.index') }}" class="nav-link">
                            Buy Bitcoin </a>
                    </li>
                    <li>
                        <a id="m_faq" href="{{ route('faq.index') }}" class="nav-link">
                            FAQ </a>
                    </li>
                    <li>
                        <a id="m_contact" href="{{ route('contact.index') }}" class="nav-link " rel="nofollow">
                            Contact us </a>
                    </li>

                </ul>
                <div class="login">

                    @guest
                        <a href="{{ route('auth.signup') }}" class="nav-link sign-up-mobile ">
                            Sign Up </a>
                    @endguest

                </div>
            </div>
        </nav>
        <div class="main-wrapper flex justify-flex-end main-header-wrapper">
            <div class="toggle third" id="menu-button">
                <svg viewBox="0 0 100 80" width="30" height="30" fill="#4441d4">
                    <rect width="100" height="9" rx="10"></rect>
                    <rect y="30" width="100" height="9" rx="10"></rect>
                    <rect y="60" width="100" height="9" rx="10"></rect>
                </svg>
            </div>
            <a href="{{ route('dashboard.index') }}" class="link-logo third">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Door2Coin">
            </a>
            <nav class="top-menu flex third">
                <ul class="flex justify-flex-end">
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('transaction.index') }}" class="nav-link">
                                Transactions </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('dashboard.index') }}" class="nav-link active">
                            Buy Bitcoin </a>
                    </li>
                    <li>
                        <a href="{{ route('faq.index') }}" class="nav-link ">
                            FAQ </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}" class="nav-link " rel="nofollow">
                            Contact us </a>
                    </li>
                </ul>
            </nav>
            <div class="login third">
                @if(Auth::check())
                    <div class="dropdown">
                        <button class="dropbtn"><i class="fa fa-user" style="font-size:20px"></i><span> {{Auth::user()->first_name.' '.Auth::user()->last_name}}</span></button>
                        <div class="dropdown-content">
                            <a href="{{ route('editprofile') }}">Edit Profile</a>
                            <a href="{{ route('changepassword') }}">Change Password</a>
                            <a href="{{ route('delete') }}" onclick="return confirm('Are you sure?')">Delete Account
                            </a>
                            <a href="{{ route('logout') }}">Logout
                            </a>
                        </div>
                    </div>

                @else
                    <a href="{{ route('auth.signup') }}" class="nav-link sign-up login-link ">
                        Sign Up </a>
                    <a href="{{ route('auth.signin') }}" class="nav-link login-link ">
                        <i class="icon-user"></i><p>Log in</p>
                    </a>
                @endif

            </div>
        </div>
    </header>
@show
