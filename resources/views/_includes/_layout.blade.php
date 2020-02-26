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

  <script src={{ asset('js/app.js')}}></script>

  @if(Route::currentRouteName() === 'admin.post.create' || Route::currentRouteName() === 'admin.post.edit')
    @include('_includes._script--tinymce')
  @endif

  @if(Route::currentRouteName() === 'user.payment.create')
      @include('_includes._script--payment')
  @endif

  {{-- 記事詳細ページでサイドバー追従用スクリプト読み込み --}}
  @if (Route::currentRouteName() === 'post')
    <script src="/js/sideFixed.js"></script>
  @endif

</body>
</html>