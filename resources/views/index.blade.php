@extends('layouts.base')
@section('content')
<div class="py-2">
  <ul class="last-border-none">
    @foreach($posts as $id => $post)
      <li class="border-b border-gray-300">
        <a href="/{{ $post->id }}" class="block flex px-4 py-2">
          <img class="mr-2" src="http://placehold.jp/200x150.png" alt="">
          {{-- <span>{{ $post->post_thumbnail }}</span> --}}
          <div>
            <span class="text-gray-600">{{ $post->post_published->format('Y.m.d') }}</span>
            <h2 class="text-lg sm:text-2xl mb-2">{{ $post->post_title }}</h2>
            <p class="text-gray-700">{{ $post->post_excerpt }}</p>
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
