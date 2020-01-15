@extends('_includes._authLayout')
@section('auth-content')
@section('title', パスワードリセット)

<form method="POST" action="{{ route('password.update') }}">

  @csrf

  <input type="hidden" name="token" value="{{ $token }}">

  <ul>
    <li>@include('_includes._m-email')</li>
    <li>@include('_includes._m-password')</li>
    <li>@include('_includes._m-passwordConfirmation')</li>
  </ul>

  <div class="py-4">
    <button type="submit" class="btn-blue">パスワードリセット</button>
  </div>

</form>

@endsection
