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
                        <form>
                            <div class="search_bar">
                                <input type="text" class="form-control" placeholder="Invoice ID">
                                <input type="submit" value="Search">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
    </main>
@endsection

@section('additional-js')
    <!-- SPECIFIC SCRIPTS -->
@endsection
