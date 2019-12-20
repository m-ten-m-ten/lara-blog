<!doctype html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('common.head')

<body class="h-full">

  <div class="relative min-h-full">
    @include('common.header')

    <div class="mt-6 pb-16 px-4 max-w-5xl mx-auto">
      @yield('content')
    </div>

    @include('common.footer')
  </div>
@include('common.script')

</body>
</html>