<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('_includes._head')

<body>
  <div id="container">
    @include('_includes._l-header')

    <div id="main" class="l-container">
      @yield('content')
    </div>

    @include('_includes._l-footer')
  </div>

  @include('_includes._m-script')

  @auth('admin')
    @include('_includes._m-script--tinymce')
  @endauth

</body>
</html>