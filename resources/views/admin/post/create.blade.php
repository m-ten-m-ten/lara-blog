@extends('_includes._layout')
@section('content')

<div class="l-admin-create">

  <form method="POST">
  @csrf

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">{{ ($post->exists)? '投稿編集': '投稿新規作成'}}</h1>
      <a class="m-button" href="{{ route('admin.post.index') }}">投稿一覧</a>
    </div>

    <div class="m-admin-header-right">
      @if($post->post_published == null)
      <button class="m-button--inverse" type="submit" name="submit_btn" value="draft_btn">下書き保存</button>
      <button class="m-button" type="submit" name="submit_btn" value="publish_btn">公開<span class="overSP">する</span></button>
      @elseif($post->post_status == 'drafted')
      <button class="m-button--inverse" type="submit" name="submit_btn" value="draft_btn">下書き保存</button>
      <button class="m-button" type="submit" name="submit_btn" value="modify_btn">更新する</button>
      @else
      <button class="m-button--inverse" type="submit" name=" submit_btn" value="draft_btn">下書きにして保存</button>
      <button class="m-button" type="submit" name="submit_btn" value="modify_btn">更新する</button>
      @endif
    </div>
  </div>

    {{-- 管理者画面メイン --}}

  <div class="m-admin-form">

    <div class="m-form m-admin-form-left">

      @include('_includes._m-error')
      @include('_includes._m-status')

      <div class="m-form-row">
      <label class="m-form-title">タイトル</label>
        <input name="post_title" class="m-form-input" type="text" value="{{ old('post_title', $post->post_title) }}" required maxlength="100">
      </div>

      <div class="m-form-row">
        <label for="" class="m-form-title">本文</label>
        <textarea id="post_content" name="post_content" class="post-content" type="text" rows="20">{{ old('post_content', $post->post_content) }}</textarea>
      </div>

    </div>

    {{-- サイドバー --}}
    <div class="m-form  m-admin-form-right">

      {{-- 公開範囲 --}}
      <div class="m-form-row">
        <h2 class="m-form-title">公開範囲</h2>
        <input type="radio" id="public" name="for_subscriber" value=0 @if(old('for_subscriber', $post->for_subscriber) == 0) checked @endif><label for="public">無料記事</label>
        <input type="radio" id="subscriber" name="for_subscriber" value=1 @if(old('for_subscriber', $post->for_subscriber) == 1) checked @endif><label for="subscriber">有料記事</label>
      </div>

      {{-- ステータス --}}
      <div class="m-form-row">
        <h2 class="m-form-title">日付</h2>
        <div>ステータス：<span class="emphasis">@if($post->exists){{ $post->post_status == 'drafted' ? '下書き' : '公開中'}}@else - @endif</span><br>
          {!! $post->post_published ? '公開日時：' . $post->post_published->format('Y/m/d H:i') . '<br>' : '' !!}
          {!! $post->post_modified ? '更新日時：' . $post->post_modified->format('Y/m/d H:i') . '<br>' : '' !!}
          {{ $post->post_status == 'drafted' ? '下書き保存日時：' . $post->post_drafted->format('Y/m/d H:i') : '' }}
        </div>
      </div>

      {{-- サムネイル画像 --}}
      <div class="m-form-row">
        <h2 class="m-form-title">サムネイル画像</h2>
        <img id="selected_thumb_img" class="block" src="{{$post->thumbnail_path?: ''}}" alt="" width="120px">
        <button type="button" id="modal-open" class="m-button mt5">画像を選択</button>

        {{-- モーダル画面サムネイル画像 --}}
        <div id="modal" class="m-modal">
          <div class="m-modal-inner">
            <button type="button" id="modal-close">☓</button>

            <div class="m-thumbnail-modal">

              <div class="thumbnail-list">
                @foreach ($images as $image)
                <input id="post_thumbnail_{{ $image->id }}" type="radio" name="image_id" value="{{ $image->id }}" class="hidden radio"
                @if( old('image_id') == $image->id ) checked @endif>
                <label class="m-thumbnail-modal-list-label" for="post_thumbnail_{{ $image->id }}">
                  <img src="{{ $image->path }}" alt="" width="120px">
                  <div class="text-center text-sm">{{ $image->file_name }}</div>
                </label>
                @endforeach
              </div>

              {{ $images->links() }}

            </div>

          </div>
        </div>
      </div>

      {{-- 記事抜粋 --}}
      <div class="m-form-row">
        <h2 class="m-form-title">記事抜粋</h2>
        <textarea name="post_excerpt" class="m-form-input" rows="4" maxlength="200">{{ old('post_excerpt', $post->post_excerpt) }}</textarea>
      </div>

      {{-- カテゴリー --}}
      <div class="m-form-row">
        <h2 class="m-form-title">カテゴリー</h2>
        <select class="w-full" name="category_id">
          <option value="">カテゴリーを選択</option>
          @foreach ($categoryList as $key => $val)
            <option value="{{ $key }}" @if (old('category_id', $post->category_id) == $key) selected @endif>{{ $val }}</option>
          @endforeach
        </select>
        <a href="{{ route('admin.category.create') }}" class="text-link mt5 block">カテゴリーを新規作成</a>
      </div>

      {{-- タグ --}}
      <div class="m-form-row">
        <h2 class="m-form-title">タグ</h2>
        @foreach ($tagList as $key => $val)
          <input type="checkbox" class="hidden m-form-checkbox-tag" id="tag{{ $key}}" name="tags[]" value="{{ $key }}" @if (old('tags', $post->tags)->contains($key)) checked @endif>
          <label for="tag{{ $key }}" class="inline-block mr5 mb10">{{ $val}}</label>
        @endforeach
        <a href="{{ route('admin.tag.create') }}" class="text-link mt5 block">タグを新規作成</a>
      </div>

      {{-- スラッグ --}}
      <div class="m-form-row">
        <h2 class="m-form-title">スラッグ</h2>
        <div>（使用可能：数字 / 英字(小文字) / - / _ ）</div>
          <input name="post_name" id="" class="m-form-input" value="{{ old('post_name', $post->post_name) }}" maxlength="50" pattern="^[-_a-z0-9]{1,50}$"></input>

      </div>
    </div>
  </div>

  </form>

</div>
@endsection