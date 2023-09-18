@if($page == "Keranjang Laundry" || $page == "Keranjang Kosong" || $page == "Tracking List" || $page == "Transaksi List" || $page == "Ulas Laundry")
<header id="header" data-transparent="true" data-fullwidth="true">
@else
<header id="header" data-transparent="true" data-fullwidth="true" class="dark submenu-light">    
@endif
    <div class="header-inner">
        <div class="container">
            <div id="logo">
                <a href="{{ asset('/') }}">
                    <span class="logo-default">SATORU</span>
                    <span class="logo-dark">SATORU</span>
                </a>
            </div>
            <div id="mainMenu-trigger">
                <a class="lines-button x"><span class="lines"></span></a>
            </div>
            <div id="mainMenu">
                <div class="container">
                    <nav>
                        <ul>
                            <li><a href="{{ asset('/') }}">Home</a></li>
                            <li><a href="{{ asset('/#pricelist') }}">Pricelist</a></li>
                            @if($logged_user == null)
                            <li><a href="{{ asset('/login') }}">Login</a></li>
                            @else
                            <li class="dropdown"><span class="dropdown-arrow"></span><a href="#">{{ $logged_user->nama }}</a>
                                <ul class="dropdown-menu" style="">
                                    <li><a href="{{ asset('/keranjang/list') }}">Keranjang</a></li>
                                    <li><a href="{{ asset('/tracking/list') }}">Tracking</a></li>
                                    <li><a href="{{ asset('/transaksi/list') }}">Riwayat Transaksi</a></li>
                                    <li><a href="{{ asset('/logout') }}">Logout</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>