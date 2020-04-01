<ul class="postList">
  @foreach ( $posts as $post )
    <li class="postList__item">
      <a href="/{{ $post->post_name }}" class="postList__link">
        <figure class="postList__figure">
          <img class="postList__img" src="{{$post->thumbnail?: ''}}"  loading="lazy" alt="">
        </figure>
        <div class="postList__header">
          <span class="postList__date">{{ $post->post_published->format('Y.m.d') }}</span>
          @if($post->for_subscriber == 1)
            <span class="postList__subscriber"><i class="fas fa-lock"></i></span>
          @endif
        </div>
        <div class="postList__body">
          <h2 class="postList__title">{{ $post->post_title }}</h2>
        </div>
      </a>
      <div class="postList__footer">
        @if ($post->category)
          <a class="postList__attr" href="/category/{{ $post->category->category_name }}">{{ $post->category->category_title }}</a>
        @endif
        @foreach ($post->tags as $tag)
          <a class="postList__attr" href="/tag/{{ $tag->tag_name }}">{{ $tag->tag_title }}</a>
        @endforeach
      </div>
    </li>
  @endforeach
</ul>