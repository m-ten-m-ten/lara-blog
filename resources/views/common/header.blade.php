<header class="public bg-gray-900">
  <div class="max-w-5xl mx-auto sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3">
    <div class="flex items-center justify-between px-4 py-3 sm:p-0">
      <a class="block text-4xl text-white w-40" href="{{ url('/') }}">
        {{ config('app.name') }}
      </a>
      <div class="sm:hidden header_nav_toggle dropdown_toggle ">
          <div class="header_nav_toggle_bar dropdown_toggle_bar block "></div>
      </div>
    </div>
    <nav class="sm:flex sm:items-center dropdown_menu sm:bg-gray-900 bg-gray-100 sm:inline-block hidden sm:w-auto w-full sm:block inline-block sm:static fixed ">
      <a class="block sm:text-gray-400 text-gray-900 sm:border-r sm:border-b-0 border-b sm:border-gray-400 border-gray-300 px-4 py-4 sm:py-0" href="#">カテゴリ1</a>
      <a class="block sm:text-gray-400 text-gray-900 sm:border-r sm:border-b-0 border-b sm:border-gray-400 border-gray-300 px-4 py-4 sm:py-0" href="#">カテゴリ2</a>
      <a class="block sm:text-gray-400 text-gray-900 sm:border-r sm:border-b-0 border-b sm:border-gray-400 border-gray-300 px-4 py-4 sm:py-0" href="#">カテゴリ3</a>
      <a class="block sm:text-gray-400 text-gray-900 sm:border-r sm:border-b-0 border-b sm:border-gray-400 border-gray-300 px-4 py-4 sm:py-0" href="#">カテゴリ4</a>
      <a class="block sm:text-gray-400 text-gray-900 sm:border-r sm:border-b-0 border-b sm:border-gray-400 border-gray-300 px-4 py-4 sm:py-0" href="#">カテゴリ5</a>
      <a class="block sm:text-gray-400 text-gray-900 px-4 py-4 sm:py-0" href="#">カテゴリ6</a>
    </nav>
  </div>
</header>