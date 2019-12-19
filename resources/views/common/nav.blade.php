<nav class="w-full bg-black">
  <div class="flex justify-between items-center max-w-5xl h-20 px-4 py-2 mx-auto">
    <a class="block text-4xl text-white" href="{{ url('/') }}">
      {{ config('app.name') }}
    </a>

    <div class="header_nav_toggle dropdown_toggle md:hidden">
      <div class="md:hidden block header_nav_toggle_bar dropdown_toggle_bar"></div>
    </div>
    <ul class="dropdown_menu md:flex hidden">
      <li><a class="text-gray-400 border-r border-gray-400 px-4" href="#">カテゴリ1</a></li>
      <li><a class="text-gray-400 border-r border-gray-400 px-4" href="#">カテゴリ2</a></li>
      <li><a class="text-gray-400 border-r border-gray-400 px-4" href="#">カテゴリ3</a></li>
      <li><a class="text-gray-400 border-r border-gray-400 px-4" href="#">カテゴリ4</a></li>
      <li><a class="text-gray-400 border-r border-gray-400 px-4" href="#">カテゴリ5</a></li>
      <li><a class="text-gray-400 px-4 py-2" href="#">カテゴリ6</a></li>
    </ul>
  </div>
</nav>