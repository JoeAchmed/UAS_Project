@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/listing.css') }}" rel="stylesheet">
@endsection

@section('nav-type')
    inner
@endsection

@section('content')
    <div class="top_banner">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
            <div class="container">
                @component('client.components.breadcrumb')
                    @section('page-name', 'Products')
                    @section('page-title', 'Products')
                @endcomponent
            </div>
        </div>
        <img src="{{ asset('storage/products/thumbnail-products.jpeg') }}" class="img-fluid" alt="">
    </div>
    <!-- /top_banner -->

    <div id="stick_here"></div>

    @if (request()->query('type') == 'grid')
        @include('client.components.products.grid-sidebar')
    @else
        @include('client.components.products.list')
    @endif
    <!-- /container -->
@endsection

@section('additional-js')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('client/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('client/js/specific_listing.js') }}"></script>
@endsection
