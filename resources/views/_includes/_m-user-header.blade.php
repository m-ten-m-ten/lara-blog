{{-- ユーザー画面ヘッダー --}}
<div class="m-user-header">
  <h1 class="m-user-header-title">{{ $title }}</h1>

  <div class="m-user-header-right">
    <button class="m-button"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();"
    >ログアウト</button>
    <form id="logout-form" class="hidden" action="{{ route('user.logout') }}" method="POST">
      @csrf
    </form>
  </div>
</div>