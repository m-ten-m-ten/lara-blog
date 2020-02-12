@extends('_includes._layout')
@section('content')

<div class="l-user">

  <div class="user__header">
    <h1 class="user__header-title">@yield('user-title')</h1>

    <div class="user__header-right">
      <button class="button"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();"
      >ログアウト</button>
      <form id="logout-form" class="hidden" action="{{ route('user.logout') }}" method="POST">
        @csrf
      </form>
    </div>
  </div>

  @include('_includes._status')
  @include('_includes._error')

  <div class="user__main">
    @yield('user-content')
  </div>

</div>

@endsection