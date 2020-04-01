{{--
パンくずリストを表示するページは下記の通り
・個別記事
・カテゴリー別記事一覧
・タグ別記事一覧
--}}
@if (Route::currentRouteName() === 'post' || Route::currentRouteName() === 'category' || Route::currentRouteName() === 'tag')
  <div class="breadcrumb">
    <ul>
      <li><a class="text-link" href="{{ route('home') }}">HOME</a></li>

      {{-- 個別記事の場合は所属カテゴリーがあれば表示 --}}
      @if(Route::currentRouteName() === 'post')

        @if($post->category)
          <li><a class="text-link" href="/category/{{ $post->category->id }}">カテゴリー「{{ $post->category->category_title }}」</a></li>
        @endif
        <li>記事ページ</li>

      {{-- カテゴリーorタグ別一覧ページの場合 --}}
      @else
        <li>{{ Route::currentRouteName() === 'category'? 'カテゴリー「' . $category->category_title: 'タグ「' . $tag->tag_title }}」の記事一覧</li>
      @endif
      </ul>
  </div>
@endif