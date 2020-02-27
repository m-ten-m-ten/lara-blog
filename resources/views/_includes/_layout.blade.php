<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('_includes._head')

<body>
  <div id="container">
    @include('_includes._l-header')

    <div id="main" class="l-container"
      @if (preg_match('/^admin\..+\.index$/',Route::currentRouteName()) === 1)
        data-action="admin-index"
      @else
        data-action="{{ str_replace('.', '/', Route::currentRouteName()) }}"
      @endif>
      @yield('content')
    </div>

    @include('_includes._l-footer')
  </div>

  <script src={{ asset('js/app.js')}}></script>

  @if(Route::currentRouteName() === 'admin.post.create' || Route::currentRouteName() === 'admin.post.edit')
    @include('_includes._script--tinymce')
  @endif

  @if(Route::currentRouteName() === 'user.payment.create')
      @include('_includes._script--payment')
  @endif

</body>
</html>