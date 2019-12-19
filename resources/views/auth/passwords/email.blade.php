@extends('auth.layouts.base')
@section('auth-content')
@section('title', __('Reset Password'))

<form method="POST" action="{{ route('password.email') }}">
  @csrf
  @include('auth.common.email')

  <div class="py-4">
    @include('auth.common.submit-btn', ['text' => __('Send Password Reset Link')])
  </div>

</form>

@endsection