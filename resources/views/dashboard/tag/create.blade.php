@extends('_includes._dashboardLayout')

@section('content')
<div class="container">
  <form method="POST" enctype='text'>
    @csrf
    <div class="flex justify-between items-center border-b">
      <div class="flex items-center">
      <h1>タグ{{ ($tag->exists)? '変更': '追加'}}</h1>
      <a href="/dashboard/tag" class="btn-white">タグ一覧へ</a>
      </div>

      <div class="flex items-center">
      </div>
    </div>

    <div>

      <div class="py-2">

        <div class="py-2">
          @include('_includes._m-status')
        </div>

        <div class="py-3">
          <label for="tag_title" class="text-lg font-bold py-2">タグ名</label>
          <input name="tag_title" class="my-2 px-2 py-2 border @error('tag_title') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('tag_title', $tag->tag_title) }}" required maxlength="15">
          @error('tag_title') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>

        <div class="py-3">
          <label for="tag_name" class="text-lg font-bold py-2">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</label>
          <input name="tag_name" class="my-2 px-2 py-2 border @error('tag_name') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('tag_name', $tag->tag_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
          @error('tag_name') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-blue">{{ $tag->exists ? '変更' : '登録'}}</button>

      </div>
    </div>
  </form>

</div>
@endsection