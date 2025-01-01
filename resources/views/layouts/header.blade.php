<header id="header" class="header d-flex align-items-center fixed-top bg-light">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <img src="assets/image/logo.png" alt="">
            <h1 class="fs-1">OSUA</h1>
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="{{ (request()->is('home')) ? 'active' : '' }} fs-5">Beranda</a>
                </li>
                <li>
                    <a href="{{ route('article') }}" class="{{ (request()->is('article')) ? 'active' : '' }} fs-5">Artikel</a>
                </li>
                <li>
                    <a href="{{ route('product') }}" class="{{ (request()->is('product')) ? 'active' : '' }} fs-5">Produk</a>
                </li>
                <li>
                    <a href="{{ route('hiking-trails') }}" class="{{ (request()->is('product')) ? 'active' : '' }} fs-5">Jalur Pendakian</a>
                </li>
                <li>
                    <a href="{{ route('about') }}" class="{{ (request()->is('about')) ? 'active' : '' }} fs-5">Tentang Kami</a>
                </li>
                <div id="vr" class="vr ms-4"></div>
                @guest
                    @if (Route::has('login'))
                        <li>
                            <a class="btn-login fs-5" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li>
                            <a class="btn-register fs-5 ms-lg-3" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @else
                    <li class="dropdown"><a href="#" class="fs-5"><i class="fa-solid fa-user fs-5"></i>&ensp; <span>{{ Auth::user()->name }}</span></i></a>
                        <ul>
                            <li><a href="{{ route('wishlist') }}" class="{{ (request()->is('wishlist')) ? 'active' : '' }}"><i class="fa-solid fa-heart"></i>&ensp; Wishlist</a></li>
                            <li><a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i>&ensp; Keranjang</a></li>
                            <hr class="my-0 mx-3">
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i>&ensp; Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>
