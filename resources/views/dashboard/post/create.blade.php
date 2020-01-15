@extends('_includes._dashboardLayout')

@section('content')
<div class="container">
  <form method="POST">
    @csrf

    <div class="flex justify-between items-center border-b">

      <div class="flex items-center">
        <h1>{{ ($post->exists)? '投稿編集': '新規投稿'}}</h1>
        <a href="/dashboard/post" class="btn-white">投稿一覧へ</a>
      </div>

      <div class="flex items-center">
        @if($post->post_published == null)
        <button class="btn-white" type="submit" name="submit_btn" value="draft_btn">下書き保存</button>
        <button class="btn-blue" type="submit" name="submit_btn" value="publish_btn">公開する</button>
        @elseif($post->post_status == 'drafted')
        <button class="btn-white" type="submit" name="submit_btn" value="draft_btn">下書き保存</button>
        <button class="btn-blue" type="submit" name="submit_btn" value="modify_btn">更新する</button>
        @else
        <button class="btn-white" type="submit" name=" submit_btn" value="draft_btn">下書きにして保存</button>
        <button class="btn-blue" type="submit" name="submit_btn" value="modify_btn">更新する</button>
        @endif
      </div>

    </div>

    <div class="flex flex-wrap">

      {{-- メイン --}}
      <div class="main w-full md:w-3/4 md:pr-4 pt-4">

        @include('_includes._m-error')

        <div class="py-2">
          <label>タイトル</label>
          <input name="post_title" class="text-form-xl" type="text" value="{{ old('post_title', $post->post_title) }}" required maxlength="100">
        </div>

        <div class="py-2">
          <label>本文</label>
          <textarea id="post_content" name="post_content" class="post-content" type="text" rows="20">{{ old('post_content', $post->post_content) }}</textarea>
        </div>

      </div>

      {{-- サイドバー --}}
      <div class="sidebar w-full md:w-1/4 md:pl-4 md:pt-4 md:border-l">

        {{-- ステータス --}}
        <div class="py-2 mb-1">

          <h2>日付</h2>

          <div>
            ステータス：<span class="text-lg font-bold text-blue-700">{{ $post->post_status == 'drafted' ? '下書き' : '公開中'}}</span><br>
            {!! $post->post_published ? '公開日時：' . $post->post_published->format('Y/m/d h:i') . '<br>' : '' !!}
            {!! $post->post_modified ? '更新日時：' . $post->post_modified->format('Y/m/d h:i') . '<br>' : '' !!}
            {{ $post->post_status == 'drafted' ? '下書き保存日時：' . $post->post_drafted->format('Y/m/d h:i') : '' }}
          </div>

        </div>

        {{-- サムネイル画像選択 --}}
        <div class="py-2">

          <h2>サムネイル画像</h2>

          @include('_includes._m-thumbnail')

        </div>

        {{-- 記事抜粋 --}}
        <div class="py-2 mb-1">

          <h2>記事抜粋</h2>

          <div>
            <textarea name="post_excerpt" class="text-form" rows="4" maxlength="200">{{ old('post_excerpt', $post->post_excerpt) }}</textarea>
          </div>

        </div>

        {{-- カテゴリー --}}
        <div class="py-2">

          <h2>カテゴリー</h2>

          <div class="inline-block relative w-full mb-2">

            <select name="category_id" class="block appearance-none w-full px-2 py-2">
              <option value="">カテゴリーを選択</option>
              @foreach ($categoryList as $key => $val)
              <option value="{{ $key }}" @if (old('category_id', $post->category_id) == $key) selected @endif>{{ $val }}</option>
              @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
              </svg>
            </div>
          </div>

          <p><a href="{{ route('category.create') }}" class="text-link">カテゴリーを新規作成</a></p>

        </div>

        {{-- タグ --}}
        <div class="py-2">

          <h2>タグ</h2>

          <div class="flex flex-wrap mb-2">
            @foreach ($tagList as $key => $val)
            <input type="checkbox" class="hidden check_box" id="tag{{ $key}}" name="tags[]" value="{{ $key }}" @if (old('tags', $post->tags)->contains($key)) checked @endif>
            <label for="tag{{ $key }}" class="label-blue text-blue-700 border border-blue-700 cursor-pointer px-2 py-1 m-1 rounded">{{ $val}}</label>
            @endforeach
          </div>

          <p><a href="{{ route('tag.create') }}" class="text-link">タグを新規作成</a></p>

          {{-- 投稿スラッグ --}}
          <div class="py-2 mb-1">

            <h2>スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</h2>

            <div>
              <input name="post_name" id="" class="text-form" value="{{ old('post_name', $post->post_name) }}" maxlength="50" pattern="^[-_a-z0-9]{1,50}$"></input>
            </div>

          </div>

        </div>
      </div>
    </div>
  </form>
</div>
@endsection