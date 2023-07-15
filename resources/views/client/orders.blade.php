@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/checkout.css') }}" rel="stylesheet">

    <link href="{{ asset('client/css/orders.css') }}" rel="stylesheet">
@endsection

@section('nav-type')
    inner Sticky
@endsection

@section('content')
    @if (request()->is('success'))
        {{-- Konten khusus ketika route adalah '/success' --}}
        @include('client.components.orders.success')
    @else
        {{-- Konten default atau ketika route bukan '/success' --}}
        @include('client.components.orders.main')
    @endif
    <!-- /container -->
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // Check if the query parameter 'status' is 'success'
        if ("{{ request()->is('success') }}") {
            // After 3 seconds (3000 milliseconds), redirect to '/orders' without the 'status' query parameter
            setTimeout(function() {
                window.location.href = "{{ url('orders') }}";
            }, 2000);
        }
    })
</script>
