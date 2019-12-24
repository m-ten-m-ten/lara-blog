<nav class="w-full bg-blue-900">
  <div class="flex justify-between max-w-5xl px-4 py-2 mx-auto">
    <a class="block text-2xl text-white" href="{{ url('/') }}">
      {{ config('app.name') }}
    </a>
    @guest
      <a class="block text-white text-xl" href="{{ route('login') }}">{{ __('Login') }}</a>
    @else
      <div>
        <div class="dropdown_toggle cursor-pointer inline-block relative">
          <span class="block appearance-none text-white pl-2 pr-8 py-2">{{ Auth::user()->name }}</span>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
        <div class="relative">
          <ul class="dropdown_menu hidden absolute right-0">
            <li><a class="block text-white px-4 py-2 bg-blue-900" href="{{ route('post.index') }}">投稿管理</a></li>
            <li><a class="block text-white px-4 py-2 bg-blue-900" href="{{ route('image.index') }}">画像管理</a></li>
            <li><a class="block text-white px-4 py-2 bg-blue-900" href="{{ route('category.index') }}">カテゴリー管理</a></li>
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