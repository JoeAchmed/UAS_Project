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
                @component('client.components.breadcrumb')
                    @section('page-name', 'Cart')
                @section('page-title', 'Cart')
            @endcomponent
        </div>
        <!-- /page_header -->
        @if (count($list_cart))
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
                                            <input type="number" id="quantity_{{ $item->id }}"
                                                min="{{ $item->quantity }}" value="{{ $item->quantity }}" class="qty2"
                                                name="quantity_{{ $item->id }}" max="100"
                                                style="width: 64px" />
                                            <div data-id="{{ $item->id }}" class="inc button_inc">+</div>
                                            <div data-id="{{ $item->id }}" class="dec button_inc">-</div>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div id="item_total{{ $item->id }}">
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
                                            <strong>
                                    </div>
                                </td>
                                <td class="options">
                                    <form method="POST" action="{{ route('delete.cart') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}"
                                            id="id">
                                        <button class="btn-delete" type="submit"
                                            onclick="return confirm('Anda yakin akan menghapus produk ini ?')">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
        @else
            @component('client.components.404')
                @section('desc', 'Keranjang Anda Kosong, Silakan Berbelanja Dulu')
            @endcomponent
            <div class="d-flex justify-content-center w-100 mb-5">
                <a href="{{ route('home') }}" class="btn_1">
                    Belanja Sekarang
                </a>
            </div>
        @endif
        <!-- /cart_actions -->
    </div>
    <!-- /container -->

    @if (count($list_cart))
        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <ul>
                            <li>
                                <span>Subtotal</span>
                                <div id="subtotal_cart">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                            </li>
                            <li><span>Shipping</span> Free</li>
                            <li><span>Total</span>
                                <div id="total_cart">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                            </li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="btn_1 full-width cart">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- /box_cart -->
</main>
<!--/main-->
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
            var itemId = this.getAttribute('data-id');

            if (!loading) {
                flag = "inc";
                qty = document.getElementById('quantity_' + itemId).value;
                order_id = itemId;
                qty++;
                document.getElementById('quantity_' + itemId).value = qty;
                updateQuantity();
            }
        });

        $(".dec").on("click", function(e) {
            e.preventDefault();

            var itemId = this.getAttribute('data-id');
            qty = document.getElementById('quantity_' + itemId).value;

            // Hindari pengurangan ketika sudah mencapai nilai minimum
            if (Number(qty || 0) > 1 && !loading) {
                flag = "dec";
                order_id = itemId;
                qty--;
                document.getElementById('quantity_' + itemId).value = qty;
                updateQuantity();
            }
        });

        // Fungsi untuk mengirim permintaan Ajax
        function updateQuantity() {
            var url = "{{ route('update.quantity') }}";
            var formData = new FormData();
            formData.append('action', flag);
            formData.append('cart_item_id', {{ $cart_item->id }});
            formData.append('order_id', order_id);
            formData.append('qty', qty);
            loading = true;
            $("div.wrapper-loading").addClass("show");

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
                        loading = false;
                        $("div.wrapper-loading").removeClass("show");
                        console.log(data, "check berhasil");
                        document.getElementById("item_total" + order_id).innerHTML = "Rp " + (data.response
                            .price * qty).toLocaleString("ID");
                        document.getElementById("subtotal_cart").innerHTML = "Rp " + (data.response
                            .subtotal).toLocaleString("ID");
                        document.getElementById("total_cart").innerHTML = "Rp " + (data.response.subtotal)
                            .toLocaleString("ID");
                        // Berhasil mengupdate quantity, tambahkan kode lain jika perlu
                    } else {
                        // Gagal mengupdate quantity, tambahkan kode lain jika perlu
                    }
                })
                .catch(error => {
                    console.error(error);
                    loading = false;
                    $("div.wrapper-loading").removeClass("show");

                    // Tangani kesalahan jika terjadi
                });
        }
    });
</script>
