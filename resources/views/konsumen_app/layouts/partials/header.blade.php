<!-- Start Header Area -->
<header class="header-area">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">

        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center position-relative">

                    <!-- start logo area -->
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="{{ route('konsumen.home') }}">
                                <img src="{{ asset('img/logo2.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- start logo area -->

                    <!-- main menu area start -->
                    <div class="col-lg-6 position-static">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu">
                                    <ul>
                                        <li class="{{ (Request::segment(1)=='')?'active':'' }}"><a href="{{ route('konsumen.home') }}">Home</a></li>
                                        <li class="{{ (Request::segment(1)=='shop')?'active':'' }}"><a href="{{ route('konsumen.shop') }}">shop</a>
                                        </li>
                                        {{-- <li><a href={{ route('konsumen.blog') }}>Blog</a></li> --}}
                                        <li class="{{ (Request::segment(1)=='contact-us')?'active':'' }}"><a href="{{ route('konsumen.contact') }}">Contact us</a></li>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-3">
                        <div class="header-configure-wrapper">
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li>
                                        <a href="#" class="offcanvas-btn">
                                            <i class="lnr lnr-magnifier"></i>
                                        </a>
                                    </li>
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="lnr lnr-user"></i>
                                        </a>
                                        <ul class="dropdown-list js-non-authenticated-user" style="display:none">
                                            <li><a href="{{ route('konsumen.login') }}">Login</a></li>
                                            <li><a href="{{ route('konsumen.register') }}">Register</a></li>
                                        </ul>
                                        <ul class="dropdown-list js-authenticated-user" style="display:none">
                                            <li><a href="{{ route('konsumen.profile') }}">My Account</a></li>
                                            <li><a href="javascript:void(0)" onclick="logoutAction()">Logout</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('konsumen.wishlist') }}">
                                            <i class="lnr lnr-heart"></i>
                                            <div class="notification" id="wishlist-notification">0</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="minicart-btn">
                                            <i class="lnr lnr-cart"></i>
                                            <div class="notification" id="cart-notification">0</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mini cart area end -->

                </div>
            </div>
        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->

    <!-- mobile header start -->
    <div class="mobile-header d-lg-none d-md-block sticky">
        <!--mobile header top start -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="mobile-main-header">
                        <div class="mobile-logo">
                            <a href="{{ route('konsumen.home') }}">
                                <img src="{{ asset('img/logo2.png') }}" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="mobile-menu-toggler">
                            <div class="mini-cart-wrap">
                                <a href="{{ route('konsumen.cart') }}">
                                    <i class="lnr lnr-cart"></i>
                                </a>
                            </div>
                            <div class="mobile-menu-btn">
                                <div class="off-canvas-btn">
                                    <i class="lnr lnr-menu"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header top start -->
    </div>
    <!-- mobile header end -->
</header>
<!-- end Header Area -->
