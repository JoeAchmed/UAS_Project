<main class="bg_gray">
    <div class="container margin_30">
        <div class="page_header">
            @component('client.components.breadcrumb')
                @section('page-name', 'Orders')
            @section('page-title', 'Orders')
        @endcomponent
    </div>
    @if (count($orders))

        @foreach ($orders as $item)
            <div class="d-flex justify-content-between mb-3">
                <div class="d-flex align-items-center gap-2">
                    <strong>Belanja</strong>
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                    <span
                        class="badge text-bg-{{ $item->status == 'success' ? 'success' : 'warning' }}">{{ $item->status }}</span>
                    <strong class="text-muted">#{{ $item->invoice }}</strong>
                </div>
                <button class="btn btn-primary">
                    <a href="#"><i class="ti-print"></i></a>
                    Cetak
                </button>
            </div>
            @php
                $order_items = App\Models\OrdersItemClient::join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->join('products', 'order_items.prod_id', '=', 'products.id')
                    ->join('product_categories', 'products.cat_id', '=', 'product_categories.id')
                    ->select('order_items.*', 'products.name', 'products.sell_price', 'products.discount_price', 'products.discount', 'products.thumbnail', 'product_categories.name AS category_name', 'orders.*')
                    ->where('order_items.order_id', $item->id)
                    ->get();
            @endphp
            <table class="table table-striped cart-list mb-3">
                <thead>
                    <tr>
                        <th>
                            Product
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Discount
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Subtotal
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_items as $val)
                        <tr>
                            <td class="d-flex gap-2 align-items-start">
                                <div class="thumb_cart">
                                    <img src="{{ asset('storage') . '/' . $val->thumbnail }}"
                                        data-src="{{ asset('storage') . '/' . $val->thumbnail }}" class="lazy"
                                        alt="Image">
                                </div>
                                <span class="item_cart">{{ $val->name }}</span>
                            </td>

                            <td>
                                <strong>
                                    Rp
                                    @if ($val->discount)
                                        {{ number_format($val->discount_price, 0, ',', '.') }}
                                    @else
                                        {{ number_format($val->sell_price, 0, ',', '.') }}
                                    @endif
                                </strong>
                            </td>

                            <td>
                                <strong>{{ $val->discount ? number_format($val->discount, 0) . '%' : '-' }}</strong>
                            </td>
                            <td>
                                <strong>{{ $val->quantity }}</strong>
                            </td>
                            <td>
                                <strong>Rp {{ number_format($val->price, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        @endforeach
    @else
        @component('client.components.404')
            @section('desc', 'Pesanan Anda Kosong, Silakan Berbelanja Dulu')
        @endcomponent
        <div class="d-flex justify-content-center w-100 mb-5">
            <a href="{{ route('home') }}" class="btn_1">
                Belanja Sekarang
            </a>
        </div>
    @endif
</div>
</main>
