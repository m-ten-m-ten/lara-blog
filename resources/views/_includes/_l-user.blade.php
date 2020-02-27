@extends('_includes._layout')
@section('content')

<div class="l-user">

  <div class="user__header">
    <h1 class="user__header-title">@yield('user-title')</h1>
  </div>

  @include('_includes._status')
  @include('_includes._error')

  <div class="user__main">
    @yield('user-content')
  </div>

</div>

@endsection