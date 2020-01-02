@extends('_includes._adminLayout')

@section('content')
<div class="max-w-5xl mx-auto px-4">
  <form method="POST" enctype='multipart/form-data'>
    @csrf
    <div class="flex justify-between items-center border-b">
      <div class="flex items-center">
        <h1 class="text-2xl font-bold py-4 mr-2">画像{{ ($image->exists) ? '変更' : '追加'}}</h1>
        <a href="/dashboard/image" class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" >画像一覧へ</a>
      </div>
    </div>

    <div class="">
      <div class="py-2">
        <div class="py-2">
          @include('_includes._m-status')
        </div>

        @if ($image->exists)
          <img class="block py-2" src="/img/{{ $image->image_name }}.{{ $image->image_extension }}" alt="">
        @else
          <div class="py-2">
            <label for="image_file" class="text-lg font-bold py-2">画像ファイル（jpeg / png）</label>
            <input class="block py-2" name="image_file" type="file">
                @error('image_file') <div class="text-red-500">{{ $message }}</div> @enderror
          </div>
        @endif

        <div class="py-2">
          <lavel for="image_name" class="text-lg font-bold py-2">ファイル名（使用可能：数字 / 英字(小文字) / - / _ ）</lavel>
          <input name="image_name" class="my-2 px-2 py-2 border @error('image_name') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('image_name', $image->image_name) }}">
          @error('image_name') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>

        @if ($image->exists)
          @include('_includes._m-button', ['text' => '変更'])
        @else
          @include('_includes._m-button', ['text' => '登録'])
        @endif

      </div>
    </div>
  </form>

</div>
@endsection