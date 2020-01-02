@extends('_includes._authLayout')
@section('auth-content')
@section('title', __('Reset Password'))

<form method="POST" action="{{ route('password.email') }}">
  @csrf
  @include('_includes._m-email')

  <div class="py-4">
    @include('_includes._m-button', ['text' => __('Send Password Reset Link')])
  </div>

</form>

@endsection