<header class="public">
  <div class="bg-gray-900 h-20">
    <div class="container mx-auto">
      <div class="flex justify-between items-start  px-4 py-3">
        <a class="block text-4xl text-white w-40" href="{{ url('/') }}">
          {{ config('app.name') }}
        </a>
        <div class="hidden sm:flex justify-end items-end text-white">
          <div id="category_btn" class="text-center cursor-pointer py-2 px-4">
            <div>CATEGORY</div>
            <div class="text-blue-400 text-xs">●</div>
          </div>
          <div id="tag_btn" class="text-center cursor-pointer py-2 px-4">
            <div>TAG</div>
            <div class="text-blue-400 text-xs">●</div>
          </div>
        </div>
        <div class="sm:hidden header_nav_toggle dropdown_toggle ">
            <div class="header_nav_toggle_bar dropdown_toggle_bar block "></div>
        </div>
      </div>
    </div>
  </div>
  <div id="category_menu" class="bg-gray-300 py-2 w-full hidden">
    <div class="container mx-auto text-gray-700 flex flex-wrap justify-center">
      @foreach ($categories as $category)
        <a href="/category/{{ $category->id }}" class="block hover:text-gray-600 px-4 py-4 w-32">{{ $category->category_title}}</a>
      @endforeach
    </div>
  </div>
  <div id="tag_menu" class="bg-gray-300 py-2 w-full hidden">
    <div class="container mx-auto text-gray-700 flex flex-wrap justify-center">
      @foreach ($tags as $tag)
        <a href="/tag/{{ $tag->id }}" class="block hover:text-gray-600 px-4 py-4 w-32">{{ $tag->tag_title}}</a>
      @endforeach
    </div>
  </div>

  <div class="dropdown_menu hidden bg-gray-300 py-2 w-full sm:static fixed">
    <div class="container mx-auto">
      <nav class="text-gray-700">
        <div class="sm:hidden text-center py-4">CATEGORY</div>
        <div class="flex flex-wrap justify-center">
          @foreach ($categories as $category)
            <a href="/category/{{ $category->id }}" class="block hover:text-gray-600 sm:border-0 border border-gray-500 rounded-full px-4 py-4 sm:w-32 w-auto sm:mb-0 mb-2 sm:mr-0 mr-2">{{ $category->category_title}}</a>
          @endforeach
        </div>
        <div class="sm:hidden text-center py-4">TAG</div>
        <div class="flex flex-wrap justify-center">
          @foreach ($tags as $tag)
                <a href="/tag/{{ $tag->id }}" class="block hover:text-gray-600 sm:border-0 border border-gray-500 rounded-full px-4 py-4 sm:w-32 w-auto sm:mb-0 mb-2 sm:mr-0 mr-2">{{ $tag->tag_title}}</a>
          @endforeach
        </div>
      </nav>
    </div>
  </div>
</header>