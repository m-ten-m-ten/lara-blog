<ul class="dropdown-menu">

  @isset ($categories)
    <li id="menu01"><a href="#">カテゴリー</a>
      <div id="menu01-sub" class="m-headerNav-child l-container-pcFull">
        <div class="l-container m-headerNav-child-inner">
          @foreach ($categories as $category)
            <a href="/category/{{ $category->id }}">{{ $category->category_title}}({{ $category->posts_count }})</a>
          @endforeach
        </div>
      </div>
    </li>
  @endisset

  @isset ($tags)
    <li id="menu02"><a href="#">タグ</a>
      <div id="menu02-sub" class="m-headerNav-child l-container-pcFull">
        <div class="l-container m-headerNav-child-inner">
          @foreach ($tags as $tag)
            <a href="/tag/{{ $tag->id }}">{{ $tag->tag_title}}({{ $tag->posts_count }})</a>
          @endforeach
        </div>
      </div>
    </li>
  @endisset

  @auth('user')
    <li><a href="{{ route('user.top') }}">{{ Auth::guard('user')->user()->name }}さんページ</a></li>
    <li>
      <a href="{{ route('user.logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();
        ">ログアウト</a>
      <form id="logout-form" class="hidden" action="{{ route('user.logout') }}" method="POST">
        @csrf
      </form>
    </li>
  @endauth

  @guest('user')
    <li><a href="{{ route('user.login') }}">ログイン</a></li>
    <li><a href="{{ route('signup.index') }}">ユーザー登録</a></li>
  @endguest

  @auth('admin')
    <li><a href="{{ route('admin.top') }}">管理者トップ</a></li>
  @endauth

</ul>