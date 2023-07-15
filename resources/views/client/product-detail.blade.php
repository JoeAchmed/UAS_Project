@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/product_page.css') }}" rel="stylesheet">
@endsection

@section('nav-type')
    inner Sticky
@endsection

@section('content')
    <div class="container margin_30">
        <div class="row">
            <div class="col-md-6">
                <div class="all">
                    <div class="slider">
                        <div class="owl-carousel owl-theme main">
                            @foreach ($product_images as $item)
                                <div style="
                            background-image: url({{ asset('storage') . '/' . $item->path }});
                        "
                                    class="item-box"></div>
                            @endforeach
                        </div>
                        <div class="left nonl">
                            <i class="ti-angle-left"></i>
                        </div>
                        <div class="right">
                            <i class="ti-angle-right"></i>
                        </div>
                    </div>
                    <div class="slider-two">
                        <div class="owl-carousel owl-theme thumbs">
                            @foreach ($product_images as $item)
                                <div style="
                            background-image: url({{ asset('storage') . '/' . $item->path }});
                        "
                                    class="item active"></div>
                            @endforeach
                        </div>
                        <div class="left-t nonl-t"></div>
                        <div class="right-t"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @component('client.components.breadcrumb')
                    @section('page-name', 'Detail Product')
                @endcomponent
                <!-- /page_header -->
                <form method="POST" action="{{ route('create.cart') }}">
                    @csrf
                    <div class="prod_info">
                        <h1>{{ $product->name }}</h1>

                        <span class="rating mt-lg-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $product->rating)
                                    <i class="icon-star voted"></i>
                                @else
                                    <i class="icon-star"></i>
                                @endif
                            @endfor
                            <em>{{ number_format($product->rating, 0) }}
                                reviews</em>
                        </span>
                        <p>
                            <small>SKU: {{ $product->sku }}</small>
                            <br />
                            {{ $product->description }}
                        </p>
                        <div class="prod_options">
                            <div class="row">
                                <label class="col-xl-5 col-lg-5 col-md-6 col-6 pt-0"><strong>Color</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6 colors">
                                    <ul>
                                        <li>
                                            <a href="#0" class="color color_1 active"></a>
                                        </li>
                                        <li>
                                            <a href="#0" class="color color_2"></a>
                                        </li>
                                        <li>
                                            <a href="#0" class="color color_3"></a>
                                        </li>
                                        <li>
                                            <a href="#0" class="color color_4"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Size</strong> - Size Guide
                                    <a href="#0" data-bs-toggle="modal" data-bs-target="#size-modal"><i
                                            class="ti-help-alt"></i></a></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                    <div class="custom-select-form">
                                        <select disabled name="size" id="size" class="wide">
                                            <option value="S" selected>
                                                Small (S)
                                            </option>
                                            <option value="M">Medium (M)</option>
                                            <option value="L">Large (L)</option>
                                            <option value="XL">
                                                XL (X-Large)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>Quantity</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">

                                    <div class="numbers-row">
                                        <input type="number" id="qty" min="1" value="1" class="qty2"
                                            name="qty" max="100" style="width: 64px" />
                                        <div data-id="{{ $product->id }}" class="inc button_inc">+</div>
                                        <div data-id="{{ $product->id }}" class="dec button_inc">-</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main">
                                    @if ($product->discount)
                                        <span class="new_price">Rp
                                            {{ number_format($product->discount_price, 0, ',', '.') }}</span><span
                                            class="percentage">-{{ number_format($product->discount, 0) }}%</span>
                                        <span class="old_price">Rp
                                            {{ number_format($product->sell_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="new_price">Rp
                                            {{ number_format($product->sell_price, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">

                                <input type="hidden" name="prod_id" value="{{ $product->id }}" id="prod_id">

                                <button type="submit" class="btn-add-cart">
                                    <div class="btn_add_to_cart">
                                        <a class="btn_1">Add to Cart</a>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /prod_info -->
                <div class="product_actions">
                    <ul>
                        <li>
                            <a href="#"><i class="ti-heart"></i><span>Add to Wishlist</span></a>
                        </li>
                        <li>
                            <a href="#"><i class="ti-control-shuffle"></i><span>Add to Compare</span></a>
                        </li>
                    </ul>
                </div>
                <!-- /product_actions -->
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->

    <div class="tabs_product">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab"
                        role="tab">Description</a>
                </li>
                <li class="nav-item">
                    <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab" role="tab">Reviews</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /tabs_product -->
    <div class="tab_content_wrapper">
        <div class="container">
            <div class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                    <div class="card-header" role="tab" id="heading-A">
                        <h5 class="mb-0">
                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false"
                                aria-controls="collapse-A">
                                Description
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <h3>Details</h3>
                                    {{ $product->description }}
                                </div>
                                <div class="col-lg-5">
                                    <h3>Specifications</h3>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <strong>Color</strong>
                                                    </td>
                                                    <td>
                                                        Blue, Purple
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Size</strong>
                                                    </td>
                                                    <td>
                                                        {{ $product->size ? $product->size : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Weight</strong>
                                                    </td>
                                                    <td>{{ $product->weight ? $product->weight : '0' }} kg</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Manifacturer</strong>
                                                    </td>
                                                    <td>
                                                        {{ $product->manifacturer ? $product->manifacturer : '-' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /table-responsive -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /TAB A -->
                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                    <div class="card-header" role="tab" id="heading-B">
                        <h5 class="mb-0">
                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                aria-controls="collapse-B">
                                Reviews
                            </a>
                        </h5>
                    </div>
                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><em>5.0/5.0</em></span>
                                            <em>Published 54
                                                minutes ago</em>
                                        </div>
                                        <h4>
                                            "Commpletely satisfied"
                                        </h4>
                                        <p>
                                            Eos tollit ancillae ea,
                                            lorem consulatu qui ne,
                                            eu eros eirmod scaevola
                                            sea. Et nec tantas
                                            accusamus salutatus, sit
                                            commodo veritus te, erat
                                            legere fabulas has ut.
                                            Rebum laudem cum ea, ius
                                            essent fuisset ut.
                                            Viderer petentium cu
                                            his.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><i class="icon-star empty"></i><i
                                                    class="icon-star empty"></i><em>4.0/5.0</em></span>
                                            <em>Published 1 day
                                                ago</em>
                                        </div>
                                        <h4>"Always the best"</h4>
                                        <p>
                                            Et nec tantas accusamus
                                            salutatus, sit commodo
                                            veritus te, erat legere
                                            fabulas has ut. Rebum
                                            laudem cum ea, ius
                                            essent fuisset ut.
                                            Viderer petentium cu
                                            his.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row justify-content-between">
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star empty"></i><em>4.5/5.0</em></span>
                                            <em>Published 3 days
                                                ago</em>
                                        </div>
                                        <h4>"Outstanding"</h4>
                                        <p>
                                            Eos tollit ancillae ea,
                                            lorem consulatu qui ne,
                                            eu eros eirmod scaevola
                                            sea. Et nec tantas
                                            accusamus salutatus, sit
                                            commodo veritus te, erat
                                            legere fabulas has ut.
                                            Rebum laudem cum ea, ius
                                            essent fuisset ut.
                                            Viderer petentium cu
                                            his.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="review_content">
                                        <div class="clearfix add_bottom_10">
                                            <span class="rating"><i class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><i class="icon-star"></i><i
                                                    class="icon-star"></i><em>5.0/5.0</em></span>
                                            <em>Published 4 days
                                                ago</em>
                                        </div>
                                        <h4>"Excellent"</h4>
                                        <p>
                                            Sit commodo veritus te,
                                            erat legere fabulas has
                                            ut. Rebum laudem cum ea,
                                            ius essent fuisset ut.
                                            Viderer petentium cu
                                            his.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <p class="text-end">
                                <a href="leave-review.html" class="btn_1">Leave a review</a>
                            </p>
                        </div>
                        <!-- /card-body -->
                    </div>
                </div>
                <!-- /tab B -->
            </div>
            <!-- /tab-content -->
        </div>
        <!-- /container -->
    </div>
    <!-- /tab_content_wrapper -->

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Related</h2>
            <span>Products</span>
            <p>
                Cum doctus civibus efficiantur in imperdiet
                deterruisset.
            </p>
        </div>
        <div class="owl-carousel owl-theme products_carousel">
            @foreach ($products as $p)
                <div class="item" key="{{ $p->id }}">
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
                            {{-- <div data-countdown="2019/05/15" class="countdown"></div> --}}
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
                                <form method="POST" action="{{ route('create.cart') }}">
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
                <!-- /item -->
            @endforeach
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->

    <div class="feat">
        <div class="container">
            <ul>
                <li>
                    <div class="box">
                        <i class="ti-gift"></i>
                        <div class="justify-content-center">
                            <h3>Free Shipping</h3>
                            <p>For all oders over $99</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-wallet"></i>
                        <div class="justify-content-center">
                            <h3>Secure Payment</h3>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-headphone-alt"></i>
                        <div class="justify-content-center">
                            <h3>24/7 Support</h3>
                            <p>Online top support</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!--/feat-->
@endsection

@section('additional-js')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('client/js/carousel_with_thumbs.js') }}"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var flag = "inc";
        var order_id = 0;
        var loading = false;
        var qty = 0;

        // Event listener untuk tombol "+"
        $(".inc").on("click", function(e) {
            e.preventDefault();
            var prod_value = this.getAttribute('data-id');

            if (!loading) {
                flag = "inc";
                qty = document.getElementById('qty').value;
                qty++;
                document.getElementById('qty').value = qty;
            }
        });

        // Tombol "-"
        $(".dec").on("click", function(e) {
            e.preventDefault();

            var prod_value = this.getAttribute('data-id');
            qty = document.getElementById('qty').value;

            // Hindari pengurangan ketika sudah mencapai nilai minimum
            if (Number(qty || 0) > 1 && !loading) {
                flag = "dec";
                order_id = prod_value;
                qty--;
                document.getElementById('qty').value = qty;
            }
        });
    })
</script>
