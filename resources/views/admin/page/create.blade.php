@extends('_includes._l-admin')
@section('jsAction', 'adminPageCreate')
@if($page->exists)
  @section('admin__title', '固定ページ変更')
@else
  @section('admin__title', '固定ページ追加')
@endif

@section('link-button')
  <a class="button" href="{{ route('admin.page.index') }}">固定ページ一覧</a>
  @if($page->exists)
    <a class="button" href="{{ route('admin.page.create') }}">新規作成</a>
  @endif
@endsection

@section('admin__content')

<div class="admin__pageForm">

  <form method="POST">
    @csrf

    <div class="form admin__pageForm-left">

      @include('_includes._error')

      <div class="form__row">
      <label class="form__title">タイトル</label>
        <input name="page_title" class="form__input" type="text" value="{{ old('page_title', $page->page_title) }}" required maxlength="100">
      </div>

      <div class="form__row">
        <label for="" class="form__title">本文</label>
        <textarea id="tinymce_content" name="page_content" class="page-content" type="text" rows="20">{{ old('page_content', $page->page_content) }}</textarea>
      </div>

    </div>

    {{-- サイドバー --}}
    <div class="form admin__pageForm-right">

      <div class="form__row">
        <button class="button__inverse" type="submit" name="page_status" value="drafted">下書き保存</button>
        <button class="button" type="submit" name="page_status" value="published">公開<span class="overSP">する</span></button>
      </div>

      {{-- ステータス --}}
      <div class="form__row">
        <h2 class="form__title">公開ステータス</h2>
        <div>
          ステータス：
          <span class="emphasis">
            @if($page->exists)
              {{ $page->page_status == 'drafted' ? '下書き' : '公開中'}}
            @else
              -
            @endif
          </span>
        </div>
      </div>

      <div class="form__row">
        <label class="form__title">スラッグ</label>
        <input name="page_name" class="form__input" type="text" value="{{ old('page_name', $page->page_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
      </div>

    </div>

  </form>

</div>
@endsection