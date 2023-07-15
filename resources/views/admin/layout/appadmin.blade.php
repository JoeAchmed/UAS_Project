@include('admin.layout.top')
@include('admin.layout.menu')

<!-- Layout container -->
<div class="layout-page">
  
  @include('admin.layout.nav')
  
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h6 class="fw-bold @yield('style-title')">@yield('title')</h6>
        @yield('content')
      </div>
      
@include('admin.layout.bottom')
