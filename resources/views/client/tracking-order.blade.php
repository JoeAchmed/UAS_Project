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

        <div id="track_order">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-xl-7 col-lg-9">
                        <img src="{{ asset('client/img/track_order.svg') }}" alt="" class="img-fluid add_bottom_15"
                            width="200" height="177">
                        <p>Quick Tracking Order</p>
                        <form action="{{ route('tracking') }}" method="POST">
                            @csrf
                            <div class="search_bar">
                                <input type="text" class="form-control" name="invoice" placeholder="Invoice ID">
                                <button type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
            @isset($orders)
                @foreach ($orders as $val)
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
            @endisset
        </div>
    </main>
@endsection

@section('additional-js')
    <!-- SPECIFIC SCRIPTS -->
@endsection
