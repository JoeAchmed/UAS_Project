@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/home_1.css') }}" rel="stylesheet">
@endsection

@section('nav-type')
    Sticky
@endsection

@section('content')
    <div id="carousel-home">
        <div class="owl-carousel owl-theme">
            <div class="owl-slide cover" style="background-image: url({{ asset('storage') . '/products/jumbo1.jpg' }});">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-end">
                            <div class="col-lg-6 static">
                                <div class="slide-text text-end white">
                                    <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Max 720 Sage Low</h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        Limited items available at this price
                                    </p>
                                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                            href="{{ url('/products') }}" role="button">Shop Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/owl-slide-->
            <div class="owl-slide cover" style="background-image: url({{ asset('storage') . '/products/jumbo2.jpg' }});">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-start">
                            <div class="col-lg-6 static">
                                <div class="slide-text white">
                                    <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>VaporMax Flyknit 3</h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        Limited items available at this price
                                    </p>
                                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                            href="listing-grid-1-full.html" role="button">Shop Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/owl-slide-->
            <div class="owl-slide cover" style="background-image: url({{ asset('storage') . '/products/jumbo3.jpg' }});">
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(255, 255, 255, 0.5)">
                    <div class="container">
                        <div class="row justify-content-center justify-content-md-start">
                            <div class="col-lg-12 static">
                                <div class="slide-text text-center black">
                                    <h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Monarch IV SE</h2>
                                    <p class="owl-slide-animated owl-slide-subtitle">
                                        Lightweight cushioning and durable support with a Phylon midsole
                                    </p>
                                    <div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
                                            href="listing-grid-1-full.html" role="button">Shop Now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/owl-slide-->
            </div>
        </div>
        <div id="icon_drag_mobile"></div>
    </div>
    <!--/carousel-->

    <ul id="banners_grid" class="clearfix">
        @foreach ($categories as $item)    
            <li>
                <a href="{{ url('/products?cat_id=' . $item->id) }}" class="img_container" key="{{ $item->id }}">
                    <img src="{{ asset('client/img/banners_cat_placeholder.jpg') }}"
                        data-src="{{ asset('client/img/banner_1.jpg') }}" alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>{{ $item->name }}</h3>
                        <div><span class="btn_1">Shop Now</span></div>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
    <!--/banners_grid -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Top Selling</h2>
            <span>Products</span>
            <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
        </div>

        <div class="row small-gutters">
            @foreach ($produk as $p)
                <div class="col-6 col-md-4 col-xl-3" key="{{ $p->id }}">
                    <div class="grid_item">
                        <figure>
                            <span class="ribbon new">{{ $p->category_name }}</span>
                            @if ($p->discount)
                                <span class="ribbon off"
                                    style="right: 10px; left: auto">-{{ number_format($p->discount, 0) }}%</span>
                            @endif
                            <a href="{{ route('product_detail', $p->slug) }}">
                                <img class="img-fluid lazy img-product-fit"
                                    src="{{ asset('storage') . '/' . $p->thumbnail }}"
                                    data-src="{{ asset('storage') . '/' . $p->thumbnail }}" alt="">
                                <img class="img-fluid lazy img-product-fit"
                                    src="{{ asset('storage') . '/' . $p->thumbnail }}"
                                    data-src="{{ asset('storage') . '/' . $p->thumbnail }}" alt="">
                            </a>
                            <div data-countdown="2019/05/15" class="countdown"></div>
                        </figure>
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $p->rating)
                                    <i class="icon-star voted"></i>
                                @else
                                    <i class="icon-star"></i>
                                @endif
                            @endfor
                        </div>
                        <a href="{{ route('product_detail', $p->slug) }}">
                            <h3>{{ $p->name }}</h3>
                        </a>
                        <div class="price_box">
                            @if ($p->discount)
                                <span class="new_price">Rp {{ number_format($p->discount_price, 0, ',', '.') }}</span>
                                <span class="old_price">Rp {{ number_format($p->sell_price, 0, ',', '.') }}</span>
                            @else
                                <span class="new_price">Rp {{ number_format($p->sell_price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <ul>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a>
                            </li>
                            <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
                                        compare</span></a></li>
                            <li>
                                <form method="POST" action="{{ route('create.order') }}">
                                    <a class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Add to cart">
                                        @csrf
                                        <input type="hidden" name="prod_id" value="{{ $p->id }}"
                                            id="prod_id">
                                        <button type="submit" class="btn-add-cart">
                                            <i class="ti-shopping-cart"></i>
                                            <span>Add to cart</span>
                                        </button>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- /grid_item -->
                </div>
            @endforeach
        </div>
    </div>
    <!-- /container -->

    <div class="featured lazy" data-bg="url({{ asset('client/img/featured_home.jpg') }})">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
            <div class="container margin_60">
                <div class="row justify-content-center justify-content-md-start">
                    <div class="col-lg-6 wow" data-wow-offset="150">
                        <h3>Armor<br>Air Color 720</h3>
                        <p>Lightweight cushioning and durable support with a Phylon midsole</p>
                        <div class="feat_text_block">
                            <div class="price_box">
                                <span class="new_price">$90.00</span>
                                <span class="old_price">$170.00</span>
                            </div>
                            <a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /featured -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Featured</h2>
            <span>Products</span>
            <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            <div class="item">
                <div class="grid_item">
                    <span class="ribbon new">New</span>
                    <figure>
                        <a href="{{ url('/product/detail') }}">
                            <img class="owl-lazy"
                                src="{{ asset('client/img/products/product_placeholder_square_medium.jpg') }}"
                                data-src="{{ asset('client/img/products/shoes/4.jpg') }}" alt="">
                        </a>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                            class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ url('/product/detail') }}">
                        <h3>ACG React Terra</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$110.00</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                        </li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /item -->
            <div class="item">
                <div class="grid_item">
                    <span class="ribbon new">New</span>
                    <figure>
                        <a href="{{ url('/product/detail') }}">
                            <img class="owl-lazy"
                                src="{{ asset('client/img/products/product_placeholder_square_medium.jpg') }}"
                                data-src="{{ asset('client/img/products/shoes/5.jpg') }}" alt="">
                        </a>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                            class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ url('/product/detail') }}">
                        <h3>Air Zoom Alpha</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$140.00</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                        </li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /item -->
            <div class="item">
                <div class="grid_item">
                    <span class="ribbon hot">Hot</span>
                    <figure>
                        <a href="{{ url('/product/detail') }}">
                            <img class="owl-lazy"
                                src="{{ asset('client/img/products/product_placeholder_square_medium.jpg') }}"
                                data-src="{{ asset('client/img/products/shoes/8.jpg') }}" alt="">
                        </a>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                            class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ url('/product/detail') }}">
                        <h3>Air Color 720</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$120.00</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                        </li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /item -->
            <div class="item">
                <div class="grid_item">
                    <span class="ribbon off">-30%</span>
                    <figure>
                        <a href="{{ url('/product/detail') }}">
                            <img class="owl-lazy"
                                src="{{ asset('client/img/products/product_placeholder_square_medium.jpg') }}"
                                data-src="{{ asset('client/img/products/shoes/2.jpg') }}" alt="">
                        </a>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                            class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ url('/product/detail') }}">
                        <h3>Okwahn II</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$90.00</span>
                        <span class="old_price">$170.00</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                        </li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /item -->
            <div class="item">
                <div class="grid_item">
                    <span class="ribbon off">-50%</span>
                    <figure>
                        <a href="{{ url('/product/detail') }}">
                            <img class="owl-lazy"
                                src="{{ asset('client/img/products/product_placeholder_square_medium.jpg') }}"
                                data-src="{{ asset('client/img/products/shoes/3.jpg') }}" alt="">
                        </a>
                    </figure>
                    <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
                            class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
                    <a href="{{ url('/product/detail') }}">
                        <h3>Air Wildwood ACG</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">$75.00</span>
                        <span class="old_price">$155.00</span>
                    </div>
                    <ul>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
                        </li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /item -->
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->

    <div class="bg_gray">
        <div class="container margin_30">
            <div id="brands" class="owl-carousel owl-theme">
                <div class="item">
                    <a href="#0"><img src="{{ asset('client/img/brands/placeholder_brands.png') }}"
                            data-src="{{ asset('client/img/brands/logo_1.png') }}" alt="" class="owl-lazy"></a>
                </div><!-- /item -->
                <div class="item">
                    <a href="#0"><img src="{{ asset('client/img/brands/placeholder_brands.png') }}"
                            data-src="{{ asset('client/img/brands/logo_2.png') }}" alt="" class="owl-lazy"></a>
                </div><!-- /item -->
                <div class="item">
                    <a href="#0"><img src="{{ asset('client/img/brands/placeholder_brands.png') }}"
                            data-src="{{ asset('client/img/brands/logo_3.png') }}" alt="" class="owl-lazy"></a>
                </div><!-- /item -->
                <div class="item">
                    <a href="#0"><img src="{{ asset('client/img/brands/placeholder_brands.png') }}"
                            data-src="{{ asset('client/img/brands/logo_4.png') }}" alt="" class="owl-lazy"></a>
                </div><!-- /item -->
                <div class="item">
                    <a href="#0"><img src="{{ asset('client/img/brands/placeholder_brands.png') }}"
                            data-src="{{ asset('client/img/brands/logo_5.png') }}" alt="" class="owl-lazy"></a>
                </div><!-- /item -->
                <div class="item">
                    <a href="#0"><img src="{{ asset('client/img/brands/placeholder_brands.png') }}"
                            data-src="{{ asset('client/img/brands/logo_6.png') }}" alt="" class="owl-lazy"></a>
                </div><!-- /item -->
            </div><!-- /carousel -->
        </div><!-- /container -->
    </div>
    <!-- /bg_gray -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Latest News</h2>
            <span>Blog</span>
            <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <a class="box_news" href="blog.html">
                    <figure>
                        <img src="{{ asset('client/img/blog-thumb-placeholder.jpg') }}"
                            data-src="{{ asset('client/img/blog-thumb-1.jpg') }}" alt="" width="400"
                            height="266" class="lazy">
                        <figcaption><strong>28</strong>Dec</figcaption>
                    </figure>
                    <ul>
                        <li>by Mark Twain</li>
                        <li>20.11.2017</li>
                    </ul>
                    <h4>Pri oportere scribentur eu</h4>
                    <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum
                        vidisse....</p>
                </a>
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
                <a class="box_news" href="blog.html">
                    <figure>
                        <img src="{{ asset('client/img/blog-thumb-placeholder.jpg') }}"
                            data-src="{{ asset('client/img/blog-thumb-2.jpg') }}" alt="" width="400"
                            height="266" class="lazy">
                        <figcaption><strong>28</strong>Dec</figcaption>
                    </figure>
                    <ul>
                        <li>By Jhon Doe</li>
                        <li>20.11.2017</li>
                    </ul>
                    <h4>Duo eius postea suscipit ad</h4>
                    <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum
                        vidisse....</p>
                </a>
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
                <a class="box_news" href="blog.html">
                    <figure>
                        <img src="{{ asset('client/img/blog-thumb-placeholder.jpg') }}"
                            data-src="{{ asset('client/img/blog-thumb-3.jpg') }}" alt="" width="400"
                            height="266" class="lazy">
                        <figcaption><strong>28</strong>Dec</figcaption>
                    </figure>
                    <ul>
                        <li>By Luca Robinson</li>
                        <li>20.11.2017</li>
                    </ul>
                    <h4>Elitr mandamus cu has</h4>
                    <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum
                        vidisse....</p>
                </a>
            </div>
            <!-- /box_news -->
            <div class="col-lg-6">
                <a class="box_news" href="blog.html">
                    <figure>
                        <img src="{{ asset('client/img/blog-thumb-placeholder.jpg') }}"
                            data-src="{{ asset('client/img/blog-thumb-4.jpg') }}" alt="" width="400"
                            height="266" class="lazy">
                        <figcaption><strong>28</strong>Dec</figcaption>
                    </figure>
                    <ul>
                        <li>By Paula Rodrigez</li>
                        <li>20.11.2017</li>
                    </ul>
                    <h4>Id est adhuc ignota delenit</h4>
                    <p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum
                        vidisse....</p>
                </a>
            </div>
            <!-- /box_news -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
@endsection

@section('additional-js')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('client/js/carousel-home.min.js') }}"></script>
@endsection
