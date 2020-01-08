@extends('_includes._adminLayout')
@section('content')
<div class="max-w-5xl mx-auto px-4">
  <div class="flex items-center">
    <h1 class="text-2xl font-bold py-4 mr-2">投稿一覧</h1>
    <a class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" href="/dashboard/post/create">新規追加</a>
  </div>
  <form id="delete-form" method="POST" action="/dashboard/post/delete">
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
      <button id="multipleSubmitBtn" class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" type="submit" name="checked" value="checked" onClick="delete_alert(event);return false;">適用</button>
    </div>
    <table class="table-auto w-full border mb-4">
      <tr>
        <th class="font-normal text-left border-b px-4 py-2"><input type="checkbox" id="all"></th>
        <th class="font-normal text-left border-b px-4 py-2 md:w-1/3 w-1/2">タイトル</th>
        <th class="font-normal text-left border-b px-4 py-2 hidden md:table-cell">カテゴリー</th>
        <th class="font-normal text-left border-b px-4 py-2 hidden md:table-cell">タグ</th>
        <th class="font-normal text-left border-b px-4 py-2">日付</th>
        <th class="font-normal text-left border-b px-4 py-2 md:w-32 w-16"></th>
      </tr>
      <tbody id="boxes">
        @foreach ($posts as $post)
        <tr class="{{ $loop->odd ? 'bg-gray-100' : ''}}">
          <td class="px-4 py-4"><input type="checkbox" name="checkedIds[]" value="{{ $post->id }}"></td>
          <td class="px-4 py-4"><a class="text-blue-700 font-bold" href="/dashboard/post/edit/{{ $post->id }}">{{ $post->post_title }}</a>{{ $post->post_status == 'drafted' ? ' - 下書き' : ''}}</td>
          <td class="px-4 py-4 hidden md:table-cell">@if(isset($post->category_id)){{ $post->category->category_title }}@endif</td>
          <td class="flex flex-wrap px-4 py-4 hidden md:table-cell text-gray-700">
            @foreach ($post->tags as $tag)
              #{{ $tag->tag_title }} 
            @endforeach
          </td>
          <td class="px-4 py-4">
            {!! $post->post_published ? '公開日時：'.$post->post_published->format('Y/m/d h:i').'<br>' : '' !!}
            {!! $post->post_modified ? '更新日時：'.$post->post_modified->format('Y/m/d h:i').'<br>' : '' !!}
            {{ $post->post_status == 'drafted' ? '下書き：'.$post->post_drafted->format('Y/m/d h:i') : '' }}
          </td>
          <td class="px-4 py-4">
            <a class="text-blue-700 underline" href="/dashboard/post/edit/{{ $post->id }}">編集</a>
            <span class="md:inline hidden">|</span>
            <button class="text-blue-700 underline appearance-none " type="submit" name="deleteId" value="{{$post->id}}" onClick="delete_alert(event);return false;">削除</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </form>
    <div class="flex justify-center pt-2 pb-10">
      {{ $posts->links() }}
    </div>
</div>
@endsection