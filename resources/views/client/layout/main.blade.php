@include('client.layout.header')

@include('client.components.loading.client')

<main>
  @yield('content')
</main>
<!-- /main -->

@include('client.layout.footer')