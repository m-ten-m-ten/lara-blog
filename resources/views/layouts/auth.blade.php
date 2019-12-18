@extends('layouts.app')
@section('content')

<div class="flex items-center justify-center  my-4">
  <div class="md:w-1/3 sm:w-1/2 w-10/12">
    <h1 class="text-center text-xl font-bold py-2">@yield('title')</h1>

    @if (session('status'))
      <div class="bg-blue-100 text-blue-900 px-4 py-2">
        {{ session('status') }}
      </div>
    @endif

    @yield('auth-content')

  </div>
</div>
@endsection