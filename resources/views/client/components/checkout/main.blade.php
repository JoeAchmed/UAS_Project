<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            @component('client.components.breadcrumb')
                @section('page-name', 'Checkout')
            @section('page-title', 'Checkout')
        @endcomponent
    </div>
    <!-- /page_header -->
    <form method="POST" action="{{ route('create.order') }}">
        @csrf
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="step first">
                    <h3>1. User Info and Billing address</h3>
                    <div class="checkout">
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                            aria-labelledby="tab_1">
                            <div class="form-group">
                                <label for="name">Nama Pelanggan</label>
                                <input type="text" name="name" class="form-control" placeholder="name"
                                    readonly value="{{ auth()->user()->name }}" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input readonly type="email" name="email" class="form-control"
                                    placeholder="Email" value="{{ auth()->user()->email }}" />
                            </div>
                            <!-- /row -->
                            <div class="form-group">
                                <label for="address">Alamat Rumah</label>
                                <textarea readonly id="address" name="address" cols="40" rows="6" class="form-control">{{ auth()->user()->address }}</textarea>
                            </div>
                            <!-- /row -->
                            <div class="form-group">
                                <label for="phone">No. Telepon</label>
                                <input readonly type="text" name="phone" class="form-control"
                                    placeholder="Telephone" value="{{ auth()->user()->phone_number }}" />
                            </div>
                            <hr />
                            <div id="other_addr_c" class="pt-2">
                                <div class="row no-gutters">
                                    <div class="col-6 form-group pr-1">
                                        <input type="text" class="form-control" placeholder="Name" />
                                    </div>
                                    <div class="col-6 form-group pl-1">
                                        <input type="text" class="form-control" placeholder="Last Name" />
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Full Address" />
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-6 form-group pr-1">
                                        <input type="text" class="form-control" placeholder="City" />
                                    </div>
                                    <div class="col-6 form-group pl-1">
                                        <input type="text" class="form-control" placeholder="Postal code" />
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="row no-gutters">
                                    <div class="col-md-12 form-group">
                                        <div class="custom-select-form">
                                            <select class="wide add_bottom_15" name="country" id="country_2">
                                                <option value="" selected>
                                                    Country
                                                </option>
                                                <option value="Europe">
                                                    Europe
                                                </option>
                                                <option value="United states">
                                                    United states
                                                </option>
                                                <option value="Asia">
                                                    Asia
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Telephone" />
                                </div>
                            </div>
                            <!-- /other_addr_c -->
                            <hr />
                        </div>
                        <!-- /tab_1 -->
                    </div>
                </div>
                <!-- /step -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step middle payments">
                    <h3>2. Payment and Shipping</h3>
                    <ul>
                        <li>
                            <label class="container_radio">
                                <i class="fa-brands fa-cc-visa"></i>
                                Visa
                                <a href="#0" class="info" data-bs-toggle="modal"
                                    data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment_method" value="visa" checked />
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">
                                <i class="fa-brands fa-cc-mastercard"></i>
                                Master Card
                                <a href="#0" class="info" data-bs-toggle="modal"
                                    data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment_method" value="mastercard" />
                                <span class="checkmark">
                                </span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">
                                <i class="fa-brands fa-cc-paypal"></i>
                                Paypal
                                <a href="#0" class="info" data-bs-toggle="modal"
                                    data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment_method" value="paypal" />
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">
                                <i class="fa-brands fa-cc-amex"></i>
                                Amex
                                <a href="#0" class="info" data-bs-toggle="modal"
                                    data-bs-target="#payments_method"></a>
                                <input type="radio" name="payment_method" value="amex" />
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                    <div class="payment_info d-none d-sm-block">
                        <figure>
                            <img src="{{ asset('client/img/cards_all.svg') }}" alt="" />
                        </figure>
                        <p>
                            Sensibus reformidans interpretaris sit
                            ne, nec errem nostrum et, te nec meliore
                            philosophia. At vix quidam periculis.
                            Solet tritani ad pri, no iisque
                            definitiones sea.
                        </p>
                    </div>

                    <h6 class="pb-2">Shipping Method</h6>

                    <ul>
                        <li>
                            <label class="container_radio">Standard shipping<a href="#0" class="info"
                                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                <input type="radio" name="shipping_method" checked value="standard" />
                                <span class="checkmark"></span>
                            </label>
                        </li>
                        <li>
                            <label class="container_radio">Express shipping<a href="#0" class="info"
                                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                <input type="radio" name="shipping_method" value="express" />
                                <span class="checkmark"></span>
                            </label>
                        </li>
                    </ul>
                </div>
                <!-- /step -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="step last">
                    <h3>3. Order Summary</h3>
                    <div class="box_general summary">
                        <ul>
                            @foreach ($cart_items as $item)
                                <li class="clearfix">
                                    <em>{{ $item->quantity }}x {{ $item->name }}</em>

                                    <span>
                                        @if ($item->quantity)
                                            @if ($item->discount)
                                                {{ number_format($item->discount_price * $item->quantity, 0, ',', '.') }}
                                            @else
                                                {{ number_format($item->sell_price * $item->quantity, 0, ',', '.') }}
                                            @endif
                                        @else
                                            &nbsp; 0
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                        <ul>
                            <li class="clearfix">
                                <em><strong>Subtotal</strong></em>
                                <span>{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </li>
                            <li class="clearfix">
                                <em><strong>Shipping</strong></em>
                                <span>Free</span>
                            </li>
                        </ul>
                        <div class="total clearfix">
                            TOTAL <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <input type="hidden" name="shipping_price" value="{{ $subtotal }}"
                            id="shipping_price">
                        <input type="hidden" name="cart_id" value="{{ $cart_id }}"
                        id="cart_id">
                        <button class="btn-delete btn_1 full-width" type="submit">
                            <a class="btn_1 full-width">Confirm and
                                Pay</a>
                        </button>
                    </div>
                    <!-- /box_general -->
                </div>
                <!-- /step -->
            </div>
        </div>
    </form>
    <!-- /row -->
</div>
<!-- /container -->
</main>
<!--/main-->

<div class="modal fade" id="payments_method" tabindex="-1" role="dialog" aria-labelledby="payments_method_title"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="payments_method_title">Payments Methods</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Lorem ipsum dolor sit amet, oratio possim ius cu. Labore prompta nominavi sea ei. Sea no animal
                saperet gloriatur, ius iusto ullamcorper ad. Qui ignota reformidans ei, vix in elit conceptam
                adipiscing, quaestio repudiandae delicatissimi vis ei. Fabulas accusamus no has.</p>
            <p>Et nam vidit zril, pri elaboraret suscipiantur ut. Duo mucius gloriatur at, in vis integre labitur
                dolores, mei omnis utinam labitur id. An eum prodesset appellantur. Ut alia nemore mei, at velit
                veniam vix, nonumy propriae conclusionemque ea cum.</p>
        </div>
    </div>
</div>
</div>
