<div class="toolbox elemento_stick">
    <div class="container">
        <ul class="clearfix">
            <li>
                <div class="sort_select">
                    <select name="sort" id="sort">
                        <option value="popularity" selected="selected">Sort by popularity</option>
                        <option value="rating">Sort by average rating</option>
                        <option value="date">Sort by newness</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to
                    </select>
                </div>
            </li>
            <li>
                <a href="{{ url('/products?type=grid') }}"><i class="ti-view-grid"></i></a>
                <a href="{{ url('/products?type=list') }}"><i class="ti-view-list"></i></a>
            </li>
            <li>
                <a data-bs-toggle="collapse" href="#filters" role="button" aria-expanded="false"
                    aria-controls="filters">
                    <i class="ti-filter"></i><span>Filters</span>
                </a>
            </li>
        </ul>
        <div class="collapse" id="filters">
            <div class="row small-gutters filters_listing_1">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="drop">Categories</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">Men <small>12</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Women <small>24</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Running <small>23</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Training <small>11</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                                <a href="#0" class="apply_filter">Apply</a>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="drop">Color</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">Blue <small>06</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Red <small>12</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Orange <small>17</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Black <small>43</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                                <a href="#0" class="apply_filter">Apply</a>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="drop">Brand</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">Adidas <small>11</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Nike <small>08</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Vans <small>05</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">Puma <small>18</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                                <a href="#0" class="apply_filter">Apply</a>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" class="drop">Price</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">$0 — $50<small>11</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">$50 — $100<small>08</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">$100 — $150<small>05</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">$150 — $200<small>18</small>
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                                <a href="#0" class="apply_filter">Apply</a>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /toolbox -->

<div class="container margin_30">
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
                    <a href="{{ url('/product/detail') }}">
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

        {{-- if has no product/filter --}}
        @if (!count($produk))
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-xl-7 col-lg-9">
                        <img src="{{ asset('/client/img/404.svg') }}" alt="" class="img-fluid"
                            width="400" height="212">
                        <h5 class="my-5">Tidak ada produk ditemukan!</h5>
                    </div>
                </div>
                <!-- /row -->
            </div>
        @endif
        <!-- /container -->
    </div>
    <!-- /row -->

    <div class="pagination__wrapper">
        <ul class="pagination">
            <li><a href="#0" class="prev" title="previous page">&#10094;</a></li>
            <li>
                <a href="#0" class="active">1</a>
            </li>
            <li>
                <a href="#0">2</a>
            </li>
            <li>
                <a href="#0">3</a>
            </li>
            <li>
                <a href="#0">4</a>
            </li>
            <li><a href="#0" class="next" title="next page">&#10095;</a></li>
        </ul>
    </div>

</div>
<!-- /container -->
