@extends('_includes._dashboardLayout')

@section('content')
<div class="container">
  <form method="POST" enctype='text'>
    @csrf
    <div class="flex justify-between items-center border-b">
      <div class="flex items-center">
      <h1>カテゴリー{{ ($category->exists) ? '変更' : '追加'}}</h1>
      <a href="/dashboard/category" class="btn-white">カテゴリー一覧へ</a>
     </div>
    </div>

    <div>
      <div class="py-2">
        <div class="py-2">
          @include('_includes._m-status')
        </div>

        <div class="py-3">
          <label for="category_title" class="text-lg font-bold py-2">カテゴリー名</label>
          <input name="category_title" class="my-2 px-2 py-2 border @error('category_title') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('category_title', $category->category_title) }}" required maxlength="15">
          @error('category_title') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>

        <div class="py-3">
          <label for="category_name" class="text-lg font-bold py-2">スラッグ（使用可能：数字 / 英字(小文字) / - / _ ）</label>
          <input name="category_name" class="my-2 px-2 py-2 border @error('category_name') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('category_name', $category->category_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
          @error('category_name') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-blue">{{ $category->exists ? '変更' : '登録'}}</button>

      </div>
    </div>
  </form>

</div>
@endsection