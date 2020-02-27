<header class="l-header l-container--full">

  <nav class="navbar l-container">

    <div class="navbar__logo">
      <a href="{{ route('home') }}">
        {{ config('app.name') }}
      </a>
    </div>

    <div class="navbar__menu accordion-wrapper">

      <div class="navbar__menu-toggle accordion-trigger">
        <div class="navbar__menu-toggle-bar"></div>
      </div>

      <ul class="navbar__menu-body accordion-body">

        @isset ($categories)
          <li class="navbar__menu-item accordion-wrapper">
            <div class="navbar__menu-link accordion-trigger">カテゴリー</div>
            <div class="navbar__menu-child accordion-body l-container-pcFull">
              <div class="navbar__menu-child-inner l-container ">
                @foreach ($categories as $category)
                  <a href="/category/{{ $category->id }}">{{ $category->category_title}}({{ $category->posts_count }})</a>
                @endforeach
              </div>
            </div>
          </li>
        @endisset

        @isset ($tags)
          <li class="navbar__menu-item accordion-wrapper">
            <div class="navbar__menu-link accordion-trigger">タグ</div>
            <div class="navbar__menu-child accordion-body l-container-pcFull">
              <div class="navbar__menu-child-inner l-container">
                @foreach ($tags as $tag)
                  <a href="/tag/{{ $tag->id }}">{{ $tag->tag_title}}({{ $tag->posts_count }})</a>
                @endforeach
              </div>
            </div>
          </li>
        @endisset

        @auth('user')
          <li class="navbar__menu-item">
            <a class="navbar__menu-link" href="{{ route('user.top') }}">
              {{ auth('user')->user()->name }}さんページ
            </a>
          </li>
          <li class="navbar__menu-item">
            <a class="navbar__menu-link" href="{{ route('user.logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-user').submit();
              ">ログアウト</a>
            <form id="logout-user" class="hidden" action="{{ route('user.logout') }}" method="POST">
              @csrf
            </form>
          </li>
        @endauth

        @guest('user')
          <li class="navbar__menu-item">
            <a class="navbar__menu-link" href="{{ route('user.login') }}">ログイン</a>
          </li>
          <li class="navbar__menu-item">
            <a class="navbar__menu-link" href="{{ route('signup.index') }}">ユーザー登録</a>
          </li>
        @endguest

        @auth('admin')
          <li class="navbar__menu-item">
            <a class="navbar__menu-link" href="{{ route('admin.top') }}">管理者トップ</a>
          </li>
        @endauth

      </ul>
    </div>
  </nav>
</header>
