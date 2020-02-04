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

  @if(request()->path() === 'admin/post/create' || strpos(request()->path(), "/post/edit/") )
    @include('_includes._m-script--tinymce')
  @endif

  @if(request()->path()==='user/payment/create')
      @include('_includes._m-script--payment')
  @endif

</body>
</html>