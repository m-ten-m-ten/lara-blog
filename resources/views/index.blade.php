@extends('_includes._layout')

@section('content')

<div class="sm:py-2">
  <ul class="last-border-none">
    @foreach ( $posts as $id => $post )
      <li class="border-b border-gray-300 sm:py-2">
        <a href="/{{ $post->id }}" class="block flex items-start sm:px-4 py-2">
          @if (isset($post->post_thumbnail))
            <img class="md:mr-8 mr-2 sm:w-48 w-24" src="/thumbnail/{{ $post->post_thumbnail }}" alt="">
          @endif
          <div>
            <span class="text-gray-600 text-xs">{{ $post->post_published->format('Y.m.d') }}</span>
            <h2 class="sm:text-2xl leading-tight sm:mb-2">{{ $post->post_title }}</h2>
            <p class="text-gray-700 hidden sm:block">{{ $post->post_excerpt }}</p>
          </div>
        </a>
      </li>
    @endforeach
  </ul>
</div>

<div class="public flex justify-center pt-2 pb-10">
  {{ $posts->links() }}
</div>

@endsection
