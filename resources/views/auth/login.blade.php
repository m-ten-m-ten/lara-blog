@extends('_includes._authLayout')
@section('auth-content')
@section('title', __('message.login'))

<form method="POST" action="{{ route('login') }}">
  @csrf
  <ul>
    <li>@include('_includes._m-email')</li>
    <li>@include('_includes._m-password')</li>
    <li>
      <label for="remember">
        <input type="checkbox" name="remember" class="mr-1">
        <span class="text-sm">{{ __('message.remember me') }}</span>
      </label>
    </li>
  </ul>

  <div class="py-4 flex justify-between items-center">
    <button type="submit" class="btn-blue">ログイン</button>
    @if (Route::has('password.request'))
      <a class="inline-block align-baseline font-bold underline text-blue-700" href="{{ route('password.request') }}">
        パスワード
      </a>
    @endif

  </div>
</form>
@endsection
