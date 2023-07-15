  <div class="breadcrumbs">
      <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>@yield('page-name')</li>
      </ul>
  </div>
  @hasSection('page-title')
      <h1>
          @yield('page-title') Page @yield('additional-title')
      </h1>
  @endif
