@extends('auth.layouts.base')
@section('auth-content')
@section('title', __('Reset Password'))

<form method="POST" action="{{ route('password.update') }}">

  @csrf

  <input type="hidden" name="token" value="{{ $token }}">

  @include('auth.common.email')

  @include('auth.common.password')

  <label for="password-confirm" class="block font-bold py-2">{{ __('Confirm Password') }}</label>
  <input id="password-confirm" type="password" class="bg-gray-200 appearance-none border-2 @error('password') border-red-500 @else border-gray-200 @enderror rounded w-full py-2 px-4 focus:outline-none focus:bg-white focus:border-blue-700" name="password_confirmation" required autocomplete="new-password">

  <div class="py-4">
    @include('auth.common.submit-btn', ['text' => __('Reset Password')])
  </div>

</form>

@endsection
