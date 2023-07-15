@extends('client.layout.main')

@section('additional-css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('client/css/checkout.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('nav-type')
    inner Sticky
@endsection

@section('content')
    @include('client.components.checkout.main')
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
