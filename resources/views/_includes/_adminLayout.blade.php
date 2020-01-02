<!doctype html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('_includes._head')

<body class="h-full">
  <div class="relative min-h-full">
    @include('_includes._dashboardHeader')

    <div class="mt-6 pb-16 px-4 max-w-5xl mx-auto">
      @yield('content')
    </div>

    @include('_includes._footer')
  </div>

  @include('_includes._m-tinymce')
  @include('_includes._script')

</body>
</html>