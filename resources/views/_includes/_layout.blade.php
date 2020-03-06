<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('_includes._head')

<body>
  <div id="container">
    @include('_includes._l-header')

    <div id="main" class="l-container" data-action="@yield('jsAction', 'App')">
      @yield('content')
    </div>

    @include('_includes._l-footer')

    <div class="backToTop">
      <i class="fas fa-arrow-up"></i>
    </div>

  </div>

  <script src={{ asset('js/app.js')}}></script>

</body>
</html>