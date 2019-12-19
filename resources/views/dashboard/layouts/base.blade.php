<!doctype html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')

<body class="h-full">

  <div class="relative min-h-full">
    @include('dashboard.common.nav')

    <div class="pb-16">
      @yield('content')
    </div>

    @include('dashboard.common.footer')
  </div>
@include('common.script')

</body>
</html>
