<header class="l-header l-container--full">

  <div class="l-header-inner l-container">

    <div class="m-siteLogo">
      <a href="{{ route('home') }}">
        {{ config('app.name') }}
      </a>
    </div>
    <div class="m-headerNav">
      <div class="m-headerNav-toggle dropdown-toggle">
        <div class="m-headerNav-toggle-bar dropdown-toggle-bar"></div>
      </div>
      @include('_includes._m-headerNav')
    </div>
  </div>
</header>
