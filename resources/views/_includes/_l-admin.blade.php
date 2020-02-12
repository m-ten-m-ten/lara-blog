@extends('_includes._layout')
@section('content')

<div class="l-admin">

  {{-- 管理者画面ヘッダー --}}
  <div class="admin__header">
      <h1 class="admin__header-title">@yield('admin__title')</h1>
      @section('link-button')
      @show
  </div>

  {{-- 管理者画面メイン --}}
  <div class="admin__main">

    @include('_includes._status')

    <div class="admin__content">
      @yield('admin__content')
    </div>

  </div>
</div>

@endsection