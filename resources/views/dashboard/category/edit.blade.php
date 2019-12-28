@extends('dashboard.layouts.base')

@section('content')
<div class="max-w-5xl mx-auto px-4">
  <form method="POST" action="/dashboard/category/{{ $category->id }}">
    @csrf
    @method('PATCH')
    <div class="flex justify-between items-center border-b">
      <div class="flex items-center">
      <h1 class="text-2xl font-bold py-4 mr-2">ファイル名編集</h1>
      <a href="/dashboard/category" class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" >カテゴリー一覧へ</a>
      </div>

      <div class="flex items-center">
      </div>
    </div>
    <div class="flex flex-wrap">
      <div class="py-2">
        @include('common.status')
        <div class="py-3">
          <lavel for="category_title" class="text-lg font-bold py-2">カテゴリー名</lavel>
          <input name="category_title" class="my-2 px-2 py-2 border @error('category_title') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('category_title', $category->category_title) }}">
          @error('category_title') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>
        <div class="py-3">
          <lavel for="category_name" class="text-lg font-bold py-2">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</lavel>
          <input name="category_name" class="my-2 px-2 py-2 border @error('category_name') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('category_name', $category->category_name) }}">
          @error('category_name') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>
        @include('dashboard.common.blue-btn', ['text' => '変更'])
      </div>
    </div>
  </form>

</div>
@endsection