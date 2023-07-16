<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title>Allaia Store | Sahabat Belanja Anda</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('client/img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ asset('client/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('client/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ asset('client/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ asset('client/img/apple-touch-icon-144x144-precomposed.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('client/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('client/css/style.css') }}" rel="stylesheet">

    @yield('additional-css')

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('client/css/custom.css') }}" rel="stylesheet">

</head>

<body>

    <div id="page">

        <header class="version_1">
            <div class="layer"></div><!-- Mobile menu overlay mask -->
            <div class="main_header">
                <div class="container">
                    <div class="row small-gutters">
                        <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                            <div id="logo">
                                <a href="{{ url('/') }}"><img src="{{ asset('client/img/logo.svg') }}"
                                        alt="" width="100" height="35"></a>
                            </div>
                        </div>
                        <nav class="col-xl-6 col-lg-7">
                            <a class="open_close" href="javascript:void(0);">
                                <div class="hamburger hamburger--spin">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                            </a>
                            <!-- Mobile menu button -->
                            <div class="main-menu">
                                <div id="header_menu">
                                    <a href="{{ url('/') }}"><img src="{{ asset('client/img/logo_black.svg') }}"
                                            alt="" width="100" height="35"></a>
                                    <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                                </div>
                                <ul>
                                    <li class="submenu">
                                        <a href="javascript:void(0);" class="show-submenu visually-hidden">Home</a>
                                        <ul>
                                            <li><a href="index.html">Slider</a></li>
                                            <li><a href="index-2.html">Video Background</a></li>
                                            <li><a href="index-3.html">Vertical Slider</a></li>
                                            <li><a href="index-4.html">GDPR Cookie Bar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!--/main-menu -->
                        </nav>
                        <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end py-lg-3">
                            <a class="phone_top" href="tel://9438843343"><strong><span>Need Help?</span>+94
                                    423-23-221</strong></a>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <!-- /main_header -->

            <div class="main_nav @yield('nav-type')">
                <div class="container">
                    <div class="row small-gutters">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <nav class="categories">
                                <ul class="clearfix">
                                    <li><span>
                                            <a href="#">
                                                <span class="hamburger hamburger--spin">
                                                    <span class="hamburger-box">
                                                        <span class="hamburger-inner"></span>
                                                    </span>
                                                </span>
                                                Categories
                                            </a>
                                        </span>
                                        <div id="menu">
                                            <ul>
                                                @foreach ($categories as $cat)
                                                    <li key={{ $cat->name }}><span><a href="{{ url('/products?cat_id='.$cat->id) }}">{{ $cat->name }}</a></span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                            <div class="custom-search-input">
                                <input type="text" placeholder="Search over 10.000 products">
                                <button type="submit"><i class="header-icon_search_custom"></i></button>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-2 col-md-3">
                            @if (auth()->check())
                                <ul class="top_tools">
                                    <li>
                                        <div class="dropdown dropdown-access">
                                            <a href="#" class="access_link d-flex align-items-center gap-2">
                                                <strong class="text-bold">{{ auth()->user()->name }}</strong>
                                                <span>Account</span>
                                            </a>

                                            <div class="dropdown-menu">
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('/tracking-order') }}"><i class="ti-truck"></i>Track your
                                                            Order</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ url('/orders') }}"><i class="ti-package"></i>My Orders</a>
                                                    </li>
                                                    <li>
                                                        <a href="account.html"><i class="ti-user"></i>My Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="help.html"><i class="ti-help-alt"></i>Help and
                                                            Faq</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                                                class="ti-power-off"></i>{{ __('Logout') }}</a>
                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /dropdown-access-->
                                    </li>
                                    <li>
                                        <div class="dropdown dropdown-cart">
                                            <a href="{{ url('/cart') }}" class="cart_bt">
                                                @if ($cartItemsCount)
                                                    <strong>{{$cartItemsCount}}</strong>
                                                @endif
                                            </a>
                                            {{-- <div class="dropdown-menu">
                                                <ul>
                                                    <li>
                                                        <a href="product-detail-1.html">
                                                            <figure><img
                                                                    src="{{ asset('client/img/products/product_placeholder_square_small.jpg') }}"
                                                                    data-src="{{ asset('client/img/products/shoes/thumb/1.jpg') }}"
                                                                    alt="" width="50" height="50"
                                                                    class="lazy"></figure>
                                                            <strong><span>1x Armor Air x Fear</span>$90.00</strong>
                                                        </a>
                                                        <a href="#0" class="action"><i class="ti-trash"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="product-detail-1.html">
                                                            <figure><img
                                                                    src="{{ asset('client/img/products/product_placeholder_square_small.jpg') }}"
                                                                    data-src="{{ asset('client/img/products/shoes/thumb/2.jpg') }}"
                                                                    alt="" width="50" height="50"
                                                                    class="lazy"></figure>
                                                            <strong><span>1x Armor Okwahn II</span>$110.00</strong>
                                                        </a>
                                                        <a href="0" class="action"><i class="ti-trash"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="total_drop">
                                                    <div class="clearfix"><strong>Total</strong><span>$200.00</span>
                                                    </div>
                                                    <a href="{{ url('/cart') }}" class="btn_1 outline">View
                                                        Cart</a><a href="{{ url('/checkout') }}"
                                                        class="btn_1">Checkout</a>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <!-- /dropdown-cart-->
                                    </li>
                                    <li>
                                        <a href="#0" class="wishlist"><span>Wishlist</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
                                    </li>
                                    <li>
                                        <a href="#menu" class="btn_cat_mob">
                                            <div class="hamburger hamburger--spin" id="hamburger">
                                                <div class="hamburger-box">
                                                    <div class="hamburger-inner"></div>
                                                </div>
                                            </div>
                                            Categories
                                        </a>
                                    </li>
                                </ul>
                            @else
                                <div style="float: right; padding-top: 10px">
                                    <a href="{{ url('/login') }}" class="btn_1 outline border-secondary rounded">Login</a>
                                    <a href="{{ url('/register') }}" class="btn_1 outline bg-primary border-primary text-white rounded">Register</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <div class="search_mob_wp">
                    <input type="text" class="form-control" placeholder="Search over 10.000 products">
                    <input type="submit" class="btn_1 full-width" value="Search">
                </div>
                <!-- /search_mobile -->
            </div>
            <!-- /main_nav -->
        </header>
        <!-- /header -->
