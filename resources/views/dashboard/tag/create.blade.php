@extends('_includes._adminLayout')

@section('content')
<div class="max-w-5xl mx-auto px-4">
  <form method="POST" enctype='text'>
    @csrf
    <div class="flex justify-between items-center border-b">
      <div class="flex items-center">
      <h1 class="text-2xl font-bold py-4 mr-2">タグ{{ ($tag->exists)? '変更': '追加'}}</h1>
      <a href="/dashboard/tag" class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" >タグ一覧へ</a>
      </div>

      <div class="flex items-center">
      </div>
    </div>

    <div class="">
      <div class="py-2">

        <div class="py-2">
          @include('_includes._m-status')
        </div>

        <div class="py-3">
          <lavel for="tag_title" class="text-lg font-bold py-2">タグ名</lavel>
          <input name="tag_title" class="my-2 px-2 py-2 border @error('tag_title') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('tag_title', $tag->tag_title) }}">
          @error('tag_title') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>

        <div class="py-3">
          <lavel for="tag_name" class="text-lg font-bold py-2">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</lavel>
          <input name="tag_name" class="my-2 px-2 py-2 border @error('tag_name') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('tag_name', $tag->tag_name) }}">
          @error('tag_name') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>

        @if ($tag->exists)
          @include('_includes._m-button', ['text' => '変更'])
        @else
          @include('_includes._m-button', ['text' => '登録'])
        @endif

      </div>
    </div>
  </form>

</div>
@endsection