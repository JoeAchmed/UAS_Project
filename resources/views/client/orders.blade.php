@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/cart.css') }}" rel="stylesheet">
@endsection

@section('nav-type')
    inner Sticky
@endsection

@section('content')
    <main class="bg_gray py-lg-5">
        <div class="container margin_30">
            <div class="page_header">
                @component('client.components.breadcrumb')
                    @section('page-name', 'Orders')
                @section('page-title', 'Orders')
            @endcomponent
        </div>
        <table class="table table-striped cart-list">
            <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Subtotal
                    </th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <tr>
                        <td>
                            <div class="thumb_cart">
                                <img src="{{ asset('/client/img/products/product_placeholder_square_small.jpg') }}"
                                    data-src="{{ asset('/client/img/products/shoes/1.jpg') }}" class="lazy"
                                    alt="Image">
                            </div>
                            <span class="item_cart">{{ $item->name }}</span>
                        </td>
                        <td>
                            <strong>$140.00</strong>
                        </td>
                        <td>
                            <div class="numbers-row">
                                <input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
                                <div class="inc button_inc">+</div>
                                <div class="dec button_inc">-</div>
                            </div>
                        </td>
                        <td>
                            <strong>$140.00</strong>
                        </td>
                        <td class="options">
                            <a href="#"><i class="ti-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
