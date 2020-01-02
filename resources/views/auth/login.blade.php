@extends('_includes._authLayout')
@section('auth-content')
@section('title', 'Login')

<form method="POST" action="{{ route('login') }}">
  @csrf
  @include('_includes._m-email')
  @include('_includes._m-password')

  <label for="remember" class="block font-bold pt-2">
    <input type="checkbox" name="remember" class="mr-1">
    <span class="text-sm">{{ __('Remember Me') }}</span>
  </label>

  <div class="py-4 flex justify-between items-center">

    @include('_includes._m-button', ['text' => __('Login')])

    @if (Route::has('password.request'))
      <a class="inline-block align-baseline font-bold underline text-blue-700" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
      </a>
    @endif

  </div>
</form>
@endsection
