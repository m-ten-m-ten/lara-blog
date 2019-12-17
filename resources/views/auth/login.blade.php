@extends('layouts.app')
@section('content')

<div class="flex items-center justify-center my-4">
  <div>
    @if (count($errors) > 0)
    <ul>
      @foreach ($errors->all() as $err)
        <li class="text-red-500">{{ $err }}</li>
      @endforeach
    </ul>
    @endif
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <div class="py-1">
        <label for="email" class="block font-bold py-2">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 focus:outline-none focus:bg-white focus:border-blue-700" name="email" value="{{ old('email') }}">
      </div>
      <div class="py-1">
        <label for="password" class="block font-bold py-2">{{ __('Password') }}</label>
        <input id="password" type="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 focus:outline-none focus:bg-white focus:border-blue-700" name="password" value="{{ old('password') }}">
      </div>
      
      <div class="py-1">
        <label for="remember" class="block font-bold">
          <input type="checkbox" name="remember" class="mr-1">
          <span class="text-sm">{{ __('Remember Me') }}</span>
        </label>
      </div>  

      <div class="py-4">
        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 mr-2 rounded" type="submit">{{ __('Login') }}</button>

        @if (Route::has('password.request'))
          <a class="inline-block align-baseline font-bold underline text-blue-700" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
          </a>
        @endif
      </div>
    </form>
  </div>
</div>
@endsection
