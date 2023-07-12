@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/cart.css') }}" rel="stylesheet">
@endsection

@section('nav-type')
    inner Sticky
@endsection

@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Cart page</h1>
            </div>
            <!-- /page_header -->
            <table class="table table-striped cart-list">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $qty = 0;
                    @endphp
                    @if ($list_cart)
                        @foreach ($list_cart as $item)
                            <tr key="{{ $item->id }}">
                                <td>
                                    <div class="thumb_cart">
                                        <img src="{{ asset('storage') . '/' . $item->thumbnail }}"
                                            data-src="{{ asset('storage') . '/' . $item->thumbnail }}" class="lazy"
                                            alt="Image" />
                                    </div>
                                    <span class="item_cart">{{ $item->name }}</span>
                                </td>
                                <td>
                                    <strong>
                                        Rp
                                        @if ($item->discount)
                                            {{ number_format($item->discount_price, 0, ',', '.') }}
                                        @else
                                            {{ number_format($item->sell_price, 0, ',', '.') }}
                                        @endif
                                    </strong>
                                </td>
                                <td>
                                    <div class="numbers-row">
                                        <form method="POST">
                                            @csrf
                                            <input type="number" min="{{ $item->quantity }}" value="{{ $item->quantity }}" class="qty2" name="quantity_1" onclick="increase({})" />
                                            <div class="inc button_inc">+</div>
                                            <div class="dec button_inc">-</div>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <strong>
                                        Rp
                                        @if ($item->quantity)
                                            @if ($item->discount)
                                                {{ number_format($item->discount_price * $item->quantity, 0, ',', '.') }}
                                            @else
                                                {{ number_format($item->sell_price * $item->quantity, 0, ',', '.') }}
                                            @endif
                                        @else
                                            &nbsp; 0
                                        @endif
                                    </strong>
                                </td>
                                <td class="options">
                                    <a href="#"><i class="ti-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    @endif
                </tbody>
            </table>

            <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                {{-- <div class="col-sm-4 text-end">
                    <button type="button" class="btn_1 gray">
                        Update Cart
                    </button>
                </div> --}}
                <div class="col-sm-8">
                    <div class="apply-coupon">
                        <div class="form-group">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <input type="text" name="coupon-code" value="" placeholder="Promo code"
                                        class="form-control" />
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn_1 outline">
                                        Apply Coupon
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /cart_actions -->
        </div>
        <!-- /container -->

        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li>
                                <span>Subtotal</span>
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </li>
                            <li><span>Shipping</span> Rp 0</li>
                            <li><span>Total</span> Rp {{ number_format($subtotal, 0, ',', '.') }}</li>
                        </ul>
                        <a href="{{ url('/checkout') }}" class="btn_1 full-width cart">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->
    </main>
    <!--/main-->
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        var valueQty = document.getElementById("quantity_1").value || 0;

        // Event listener untuk tombol "+"
        $(".inc").on("click", function(e) {
            e.preventDefault();
            valueQty = Number(valueQty) + 1;
            updateQuantity(valueQty);
        });

        $(".desc").on("click", function(e) {
            e.preventDefault();

            // Hindari pengurangan ketika sudah mencapai nilai minimum
            if (valueQty > 1) {
                updateQuantity(valueQty - 1);
            }
        });

        // Fungsi untuk mengirim permintaan Ajax
        function updateQuantity(quantity) {
            var url = "{{ route('update.quantity') }}";
            var formData = new FormData();
            formData.append('quantity', quantity);

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Berhasil mengupdate quantity, tambahkan kode lain jika perlu
                    } else {
                        // Gagal mengupdate quantity, tambahkan kode lain jika perlu
                    }
                })
                .catch(error => {
                    console.error(error);
                    // Tangani kesalahan jika terjadi
                });
        }
    });
</script>
