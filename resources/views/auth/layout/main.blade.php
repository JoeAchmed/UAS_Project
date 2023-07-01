@include('auth.layout.header')
<!-- Content -->

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      @yield('content')
    </div>
  </div>
</div>

<!-- / Content -->
@include('auth.layout.footer')