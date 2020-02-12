@extends('_includes._layout')
@section('content')

<div class="l-form">

  <h1 class="">@yield('title')</h1>

  @include('_includes._status')

  @yield('form-content')

</div>

@endsection