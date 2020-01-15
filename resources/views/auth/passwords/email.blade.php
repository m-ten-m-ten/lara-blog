@extends('_includes._authLayout')
@section('auth-content')
@section('title', パスワードリセット)

<form method="POST" action="{{ route('password.email') }}">
  @csrf

  <ul>
    <li>@include('_includes._m-email')</li>
  </ul>

  <div class="py-4">
    <button type="submit" class="btn-blue">パスワードリセット用URLを送信</button>
  </div>

</form>
@endsection