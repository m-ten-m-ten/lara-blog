@extends('_includes._dashboardLayout')
@section('content')
<div class="container">
  <div class="flex items-center">
    <h1>タグ一覧</h1>
    <a class="btn-white" href="/dashboard/tag/create">タグ追加</a>
  </div>
  <form id="delete-form" method="POST" action="/dashboard/tag/delete">
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
      <button id="multipleSubmitBtn" class="btn-white" type="submit" name="checked" value="checked" onClick="delete_alert(event);return false;">適用</button>
    </div>
    <table class="table-auto w-full border mb-4">
      <tr>
        <th><input type="checkbox" id="all"></th>
        <th>タグ</th>
        <th>スラッグ</th>
        <th></th>
      </tr>
      <tbody id="boxes">
        @foreach ($tags as $id => $tag)
        <tr class="{{ $loop->odd ? 'bg-gray-100' : ''}}">
          <td><input type="checkbox" name="checkedIds[]" value="{{ $tag->id }}"></td>
          <td><a class="text-blue-700 font-bold" href="/dashboard/tag/edit/{{ $tag->id }}">{{ $tag->tag_title }}</a></td>
          <td>{{ $tag->tag_name }}</td>
          <td>
            <a class="text-blue-700 underline" href="/dashboard/tag/edit/{{ $tag->id }}">編集</a>
            <span class="md:inline hidden">|</span>
            <button class="text-link md:inline block md:mt-0 mt-1" type="submit" name="deleteId" value="{{$tag->id}}" onClick="delete_alert(event);return false;">削除</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </form>
    <div class="flex justify-center pt-2 pb-10">
      {{ $tags->links() }}
    </div>
</div>
@endsection