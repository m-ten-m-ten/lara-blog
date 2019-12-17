<!doctype html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="h-full">
  <div class="relative min-h-full">
    <nav class="w-full bg-blue-900">
      <div class="flex justify-between max-w-5xl px-4 py-2 mx-auto">
        <a class="block text-2xl text-white" href="{{ url('/') }}">
          {{ config('app.name') }}
        </a>
        @guest
          <a class="block text-white text-xl" href="{{ route('login') }}">{{ __('Login') }}</a>
          @if (Route::has('register'))
            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>    
          @endif
        @else
          <div>
            <div class="dropdown-toggle cursor-pointer inline-block relative">
              <span class="block appearance-none text-white pl-2 pr-8 py-2">{{ Auth::user()->name }}</span>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
              </div>
            </div>
            <div class="dropdown-menu relative">
              <ul class="hidden absolute right-0">
                <li>
                  <a class="block text-white px-4 py-2 bg-blue-900" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                  </a>
                  <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
                      @csrf
                  </form>
                </li>
              </ul>
            </div>
          </div>
        @endguest
      </div>
    </nav>

  {{-- <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav> --}}
    <div class="pb-16">
      @yield('content')
    </div>
    <footer class="absolute bottom-0 h-16 flex justify-center items-center bg-blue-900 w-full ">      
      <p class="text-white text-center">Copyright(c) 2019, {{ config('app.name') }}. All Right Reserved.</p>      
    </footer>
  </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src={{ asset('js/myscript.js')}}></script>
</body>
</html>
