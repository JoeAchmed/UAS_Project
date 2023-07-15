@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/orders.css') }}" rel="stylesheet">
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
        @if (count($orders))
            <table class="table table-striped cart-list">
                <thead>
                    <tr>
                        <th>
                            Product
                        </th>
                        <th>
                            No.Invoice
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
                            Status
                        </th>
                        <th>
                            Detail
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>
                                <div class="thumb_cart">
                                    <img src="{{ asset('storage') . '/' . $item->thumbnail }}"
                                        data-src="{{ asset('storage') . '/' . $item->thumbnail }}" class="lazy"
                                        alt="Image">
                                </div>
                                <span class="item_cart">{{ $item->name }}</span>
                            </td>

                            <td>
                                <strong>#{{ $item->invoice }}</strong>
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
                                <strong>{{ $item->quantity }}</strong>
                            </td>
                            <td>
                                <strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                <button class="btn btn-warning rounded">{{ $item->status }}</button>
                            </td>
                            <td class="options">
                                <a href="#"><i class="ti-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @component('client.components.404')
                @section('desc', 'Keranjang Anda Kosong, Silakan Berbelanja Dulu')
            @endcomponent
        @endif
    </div>
</main>
@endsection
