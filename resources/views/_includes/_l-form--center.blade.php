@extends('_includes._layout')
@section('content')

<div class="l-form--center">

  <h1 class="">@yield('title')</h1>

  @include('_includes._m-status')

  @yield('form-content')

</div>

@endsection