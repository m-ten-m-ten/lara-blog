@extends('_includes._adminLayout')

@section('content')
<div class="max-w-5xl mx-auto px-4">
  <form method="POST" enctype='text'>
    @csrf
    <div class="flex justify-between items-center border-b">
      <div class="flex items-center">
      <h1 class="text-2xl font-bold py-4 mr-2">カテゴリー{{ ($category->exists) ? '変更' : '追加'}}</h1>
      <a href="/dashboard/category" class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" >カテゴリー一覧へ</a>
     </div>
    </div>

    <div class="">
      <div class="py-2">
        <div class="py-2">
          @include('_includes._m-status')
        </div>

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

        @if ($category->exists)
          @include('_includes._m-button', ['text' => '変更'])
        @else
          @include('_includes._m-button', ['text' => '登録'])
        @endif

      </div>
    </div>
  </form>

</div>
@endsection