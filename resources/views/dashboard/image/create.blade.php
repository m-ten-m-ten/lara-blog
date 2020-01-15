@extends('_includes._dashboardLayout')

@section('content')
<div class="container">
  <form method="POST" enctype='multipart/form-data'>
    @csrf
    <div class="flex justify-between items-center border-b">
      <div class="flex items-center">
        <h1>画像{{ ($image->exists) ? '変更' : '追加'}}</h1>
        <a href="/dashboard/image" class="btn-white">画像一覧へ</a>
      </div>
    </div>

    <div>

      <div class="py-2">
        <div class="py-2">
          @include('_includes._m-status')
        </div>

        @if ($image->exists)
          <img class="block py-2" src="/img/{{ $image->image_name }}.{{ $image->image_extension }}" alt="">
        @else
          <div class="py-2">
            <label for="image_file" class="text-lg font-bold py-2">画像ファイル（jpeg / png）</label>
            <input class="block py-2" name="image_file" type="file" required>
                @error('image_file') <div class="text-red-500">{{ $message }}</div> @enderror
          </div>
        @endif

        <div class="py-2">
          <label for="image_name" class="text-lg font-bold py-2">ファイル名（使用可能：数字 / 英字(小文字) / - / _ ）</label>
          <input name="image_name" class="my-2 px-2 py-2 border @error('image_name') border-red-500 @enderror rounded w-full text-xl" type="text" value="{{ old('image_name', $image->image_name) }}" required maxlength="50" pattern="^[-_a-z0-9]{1,50}$">
          @error('image_name') <div class="text-red-500">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-blue">{{ $image->exists ? '変更' : '登録'}}</button>

      </div>
    </div>
  </form>

</div>
@endsection