@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/checkout.css') }}" rel="stylesheet">
@endsection

@section('nav-type')
    inner Sticky
@endsection

@section('content')
    @if (request()->query('status') == 'success')
        @include('client.components.checkout.success')
    @else
        @include('client.components.checkout.main')
    @endif
    <!-- /container -->
@endsection


@section('additional-js')
    <!-- SPECIFIC SCRIPTS -->
    <script>
        // Other address Panel
        $('#other_addr input').on("change", function() {
            if (this.checked)
                $('#other_addr_c').fadeIn('fast');
            else
                $('#other_addr_c').fadeOut('fast');
        });
    </script>
@endsection
