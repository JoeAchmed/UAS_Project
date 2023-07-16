@extends('client.layout.main')

@section('additional-css')
<!-- SPECIFIC CSS -->
<link href="{{ asset('client/css/error_track.css') }}" rel="stylesheet">
@endsection

@section('nav-type')
inner
@endsection

@section('content')
<main class="bg_gray">
    <div id="stick_here"></div>

    <div id="track_order" style="overflow-y: auto; min-height: 80vh;">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-7 col-lg-9">
                    <img src="{{ asset('client/img/track_order.svg') }}" alt="" class="img-fluid add_bottom_15"
                        width="200" height="177">
                    <p>Quick Tracking Order</p>

                    <form action="{{ route('tracking') }}" method="POST">
                        @csrf
                        <div class="search_bar">
                            <input type="text" class="form-control" name="invoice" placeholder="Invoice ID" required>
                            <input type="submit" name="submit" value="Search">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
        @if (isset($orders))

        @if (!count($orders))
        <div style="margin-bottom: 200px !important;">
            @component('client.components.404')
            @section('desc', 'Order tidak ditemukan :(')
            @endcomponent
        </div>
        @endif

        @foreach ($orders as $item)
        @php
        $order_items = App\Models\OrdersItemClient::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'order_items.prod_id', '=', 'products.id')
        ->join('product_categories', 'products.cat_id', '=', 'product_categories.id')
        ->select('order_items.*', 'products.name', 'products.sell_price', 'products.discount_price',
        'products.discount', 'products.thumbnail', 'product_categories.name AS category_name', 'orders.*')
        ->where('order_items.order_id', $item->id)
        ->get();
        @endphp
        <div class="container">
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
                                    data-src="{{ asset('storage') . '/' . $val->thumbnail }}" class="lazy" alt="Image">
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
        </div>
        @endforeach

        @endif
    </div>
</main>
@endsection

@section('additional-js')
<!-- SPECIFIC SCRIPTS -->
@endsection