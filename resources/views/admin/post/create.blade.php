@extends('_includes._l-admin')
@section('jsAction', 'adminPostCreate')
@if($post->exists)
  @section('admin__title', '投稿変更')
@else
  @section('admin__title', '投稿追加')
@endif

@section('link-button')
  <a class="button" href="{{ route('admin.post.index') }}">投稿一覧</a>
  @if($post->exists)
    <a class="button" href="{{ route('admin.post.create') }}">新規作成</a>
  @endif
@endsection

@section('admin__content')

<div class="admin__postForm">

  <form method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form admin__postForm-left">

      @include('_includes._error')

      <div class="form__row">
      <label class="form__title">タイトル</label>
        <input name="post_title" class="form__input" type="text" value="{{ old('post_title', $post->post_title) }}" required maxlength="100">
      </div>

      <div class="form__row">
        <label for="" class="form__title">本文</label>
        <textarea id="tinymce_content" name="post_content" class="post-content" type="text" rows="20">{{ old('post_content', $post->post_content) }}</textarea>
      </div>

    </div>

    {{-- サイドバー --}}
    <div class="form admin__postForm-right">

      <div class="form__row">
        @include('_includes._postSubmit')
      </div>

      {{-- 公開範囲 --}}
      <div class="form__row">
        <h2 class="form__title">公開範囲</h2>
        <input type="radio" id="public" name="for_subscriber" value=0 @if(old('for_subscriber', $post->for_subscriber) == 0) checked @endif><label for="public">無料記事</label>
        <input type="radio" id="subscriber" name="for_subscriber" value=1 @if(old('for_subscriber', $post->for_subscriber) == 1) checked @endif><label for="subscriber">有料記事</label>
      </div>

      {{-- ステータス --}}
      <div class="form__row">
        <h2 class="form__title">日付</h2>
        <div>ステータス：<span class="emphasis">@if($post->exists){{ $post->post_status == 'drafted' ? '下書き' : '公開中'}}@else - @endif</span><br>
          {!! $post->post_published ? '公開日時：' . $post->post_published->format('Y/m/d H:i') . '<br>' : '' !!}
          {!! $post->post_modified ? '更新日時：' . $post->post_modified->format('Y/m/d H:i') . '<br>' : '' !!}
          {{ $post->post_status == 'drafted' ? '下書き保存日時：' . $post->post_drafted->format('Y/m/d H:i') : '' }}
        </div>
      </div>

      {{-- サムネイル画像 --}}
      <div class="form__row">
        <h2 class="form__title">アイキャッチ画像</h2>
        <img class="block mb5" src="{{ old('eye_catch', $post->eye_catch) }}" width="150">
        <input name="eye_catch" type="file">
        @error('eye_catch')
          <p class="error-text">{{ $message }}</p>
        @enderror
      </div>

      {{-- 記事抜粋 --}}
      <div class="form__row">
        <h2 class="form__title">記事抜粋</h2>
        <textarea name="post_excerpt" class="form__input" rows="4" maxlength="200">{{ old('post_excerpt', $post->post_excerpt) }}</textarea>
      </div>

      {{-- カテゴリー --}}
      <div class="form__row">
        <h2 class="form__title">カテゴリー</h2>
        <select class="w-full" name="category_id">
          <option class="dummy-option" value="">カテゴリーを選択</option>
          @foreach ($categoryList as $key => $val)
            <option value="{{ $key }}" @if (old('category_id', $post->category_id) == $key) selected @endif>{{ $val }}</option>
          @endforeach
        </select>

        <div class="modal-wrapper">
          <div class="modal-open text-link mt5 pointer">カテゴリーを新規作成</div>
          <div class="modal-body ajax-wrapper__category">
            <ul class="ajax-errors error mb10"></ul>
            <form>
              @include('_includes._categoryForm')
              <span class="button ajax-submit">登録</span>
              <span class="modal-close button__inverse pointer">戻る</span>
            </form>
          </div>
        </div>

      </div>

      {{-- タグ --}}
      <div class="form__row">
        <h2 class="form__title">タグ</h2>
        <div class="select-tag">
          @foreach ($tagList as $key => $val)
            <input type="checkbox" class="hidden form__checkbox-tag" id="tag{{ $key}}" name="tags[]" value="{{ $key }}"
            @if (old('tags'))
              {{in_array("$key", old("tags")) ? 'checked' : ''}}
            @else
              {{$post->tags->contains($key) ? 'checked' : ''}}
            @endif>
            <label for="tag{{ $key }}" class="inline-block mr5 mb10">{{ $val}}</label>
          @endforeach
        </div>

        <div class="modal-wrapper">
          <div class="modal-open text-link mt5 pointer">タグを新規作成</div>
          <div class="modal-body ajax-wrapper__tag">
            <ul class="ajax-errors error mb10"></ul>
            <form>
              @include('_includes._tagForm')
              <span class="button ajax-submit">登録</span>
              <span class="modal-close button__inverse pointer">戻る</span>
            </form>
          </div>
        </div>

      </div>

      {{-- スラッグ --}}
      <div class="form__row">
        <h2 class="form__title">スラッグ</h2>
        <div>（使用可能：数字 / 英字(小文字) / - / _ ）</div>
          <input name="post_name" id="" class="form__input" value="{{ old('post_name', $post->post_name) }}" maxlength="50" pattern="^[-_a-z0-9]{1,50}$"></input>
      </div>

            <div class="form__row">
        @include('_includes._postSubmit')
      </div>

    </div>

  </form>

</div>
@endsection