@extends('dashboard.layouts.base')
@section('content')
<div class="max-w-5xl mx-auto px-4">
  <div class="flex items-center">
    <h1 class="text-2xl font-bold py-4 mr-2">画像一覧</h1>
    <a class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" href="/dashboard/image/create">画像追加</a>
  </div>
  <form method="POST" action="/dashboard/image/delete">
    @csrf
    @method('DELETE')
    <div class="py-2">
      <div class="inline-block relative">
        <select class="block appearance-none px-2 py-2 border w-32">
          <option>一括削除</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>
      <button class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" type="submit" name="checked_images" value="checked_images" onClick="delete_alert(event);return false;">適用</button>
    </div>
    <table class="table-auto w-full border mb-4">
      <tr>
        <th class="font-normal text-left border-b px-4 py-2"><input type="checkbox" id="all"></th>
        <th class="font-normal text-left border-b px-4 py-2">画像</th>
        <th class="font-normal text-left border-b px-4 py-2">URL</th>
        <th class="font-normal text-left border-b px-4 py-2">登録日</th>
      </tr>
      <tbody id="boxes">
        @foreach ($images as $id => $image)
        <tr class="{{ $loop->odd ? 'bg-gray-100' : ''}}">
          <td class="px-4 py-4"><input type="checkbox" name="checked_id[]" value="{{ $image->id }}"></td>
          <td class="px-4 py-4"><img src="http://placehold.jp/0x50.png" alt=""></td>
          <td class="px-4 py-4"><a class="text-blue-700 font-bold" href="/dashboard/image/{{ $image->id }}/edit">{{ $image->image_name }}</a></td>
          <td class="px-4 py-4">公開日時：{{ $image->created_at->format('Y/m/d h:i') }}</td>
          <td class="px-4 py-4">
            <a class="text-blue-700 underline" href="/dashboard/post/{{ $image->id }}/edit">編集</a>
            <span class="md:inline hidden">|</span>
            <button class="text-blue-700 underline appearance-none " type="submit" name="delete_id" value="{{$image->id}}" onClick="delete_alert(event);return false;">削除</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </form>
    <div class="flex justify-center pt-2 pb-10">
      {{ $images->links() }}
    </div>
</div>
@endsection