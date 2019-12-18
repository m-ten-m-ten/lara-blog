@extends('layouts.auth')
@section('auth-content')
@section('title', __('Reset Password'))

<form method="POST" action="{{ route('password.email') }}">

  @csrf

  @include('common.email')

  <div class="py-4">

    @include('common.submit-btn', ['text' => __('Send Password Reset Link')])

  </div>

</form>

@endsection