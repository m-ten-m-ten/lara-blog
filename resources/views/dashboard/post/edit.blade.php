@extends('dashboard.layouts.base')

@section('content')
<div class="max-w-5xl mx-auto px-4">
<form method="POST" action="/dashboard/post/{{ $post }}">
  @csrf
  @method('PATCH')
  <div class="flex justify-between items-center border-b">
    <div class="flex items-center">
    <h1 class="text-2xl font-bold py-4 mr-2">投稿編集</h1>
    <a href="/dashboard/post" class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" >投稿一覧へ</a>
    </div>

    <div class="flex items-center">
    @if($post->post_published == null)
      <button class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" type="submit" name="submit_btn" value="draft_btn">下書き保存</button>
      <button class=" text-white bg-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 rounded" type="submit" name="submit_btn" value="publish_btn">公開する</button>
    @elseif($post->post_status == 'drafted')
      <button class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" type="submit" name="submit_btn" value="draft_btn">下書き保存</button>
      <button class=" text-white bg-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 rounded" type="submit" name="submit_btn" value="modify_btn">更新する</button>
    @else
      <button class="text-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 border border-blue-700 rounded" type="submit" name=" submit_btn" value="draft_btn">下書きにして保存</button>
      <button class=" text-white bg-blue-700 font-bold focus:outline-none py-2 px-4 mr-2 rounded" type="submit" name="submit_btn" value="modify_btn">更新する</button>
    @endif
    </div>
  </div>

  <div class="flex flex-wrap">
    {{-- メイン --}}
    <div class="main w-full md:w-3/4 md:pr-4 pt-4">

      @include('dashboard.common.error-list')

      <div class="py-2 mb-1">
        <lavel for="post_title" class="text-lg font-bold">タイトル</lavel>
        <input name="post_title" class="px-2 py-2 border rounded w-full text-xl" type="text"
        value="{{ old('post_title', $post->post_title) }}">
      </div>
      <div class="py-2 mb-1">
        <lavel for="post_content" class="text-lg font-bold">本文</lavel>
        <textarea name="post_content" class="px-2 py-2 border rounded w-full" type="text" rows="20">{{ old('post_content', $post->post_content) }}</textarea>
      </div>
    </div>

    {{-- サイドバー --}}
    <div class="sidebar w-full md:w-1/4 md:pl-4 md:pt-4 md:border-l">

      {{-- ステータス --}}
      <div class="py-2 mb-1">
        <h2 class="border-b-2 border-blue-500 text-lg font-bold mb-2">日付</h2>
        <div class="">
          ステータス：<span class="text-lg font-bold text-blue-700">{{ $post->post_status == 'drafted' ? '下書き' : '公開中'}}</span><br>
          {!! $post->post_published ? '公開日時：'.$post->post_published->format('Y/m/d h:i').'<br>' : '' !!}
          {!! $post->post_modified ? '更新日時：'.$post->post_modified->format('Y/m/d h:i').'<br>' : '' !!}
          {{ $post->post_status == 'drafted' ? '下書き保存日時：'.$post->post_drafted->format('Y/m/d h:i') : '' }}
        </div>
      </div>

      {{-- 記事抜粋 --}}
      <div class="py-2 mb-1">
        <h2 class="border-b-2 border-blue-500 text-lg font-bold mb-2">記事抜粋</h2>
        <div class="">
          <textarea name="post_excerpt" id="" class="px-2 py-2 border rounded w-full" rows="4">{{ old('post_excerpt', $post->post_excerpt) }}</textarea>
        </div>
      </div>

      {{-- カテゴリー --}}
      <div class="py-2 mb-1">
        <h2 class="border-b-2 border-blue-500 text-lg font-bold mb-2">カテゴリー</h2>

        <div class="inline-block relative w-full">
          <select class="block appearance-none w-full px-2 py-2">
            <option>カテゴリーを選択</option>
            <option value="cat01">カテゴリー01</option>
            <option value="cat02">カテゴリー02</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
          </div>
        </div>
        <a href="#" class="text-blue-700 underline block mt-2 px-2">カテゴリーを新規作成</a>
      </div>

      {{-- タグ --}}
      <div class="py-2 mb-1">
        <h2 class="border-b-2 border-blue-500 text-lg font-bold mb-2">タグ</h2>
        <div class="flex flex-wrap">
          <input type="checkbox" class="hidden check_box" id="tag01">
          <label for="tag01" class="label-blue text-blue-700 border border-blue-700 cursor-pointer px-2 py-1 m-1 rounded">タグ01</label>
          <input type="checkbox" class="hidden check_box" id="tag02">
          <label for="tag02" class="label-blue text-blue-700 border border-blue-700 cursor-pointer px-2 py-1 m-1 rounded">タグタグ02</label><input type="checkbox" class="hidden check_box" id="tag03">
          <label for="tag03" class="label-blue text-blue-700 border border-blue-700 cursor-pointer px-2 py-1 m-1 rounded">タタグタグ03</label><input type="checkbox" class="hidden check_box" id="tag04">
          <label for="tag04" class="label-blue text-blue-700 border border-blue-700 cursor-pointer px-2 py-1 m-1 rounded">タグタグ04</label><input type="checkbox" class="hidden check_box" id="tag05">
          <label for="tag05" class="label-blue text-blue-700 border border-blue-700 cursor-pointer px-2 py-1 m-1 rounded">タaaグ05</label>
        </div>
        <a href="#" class="text-blue-700 underline block mt-2 px-2">タグを新規作成</a>
      </div>

      {{-- 投稿スラッグ --}}
      <div class="py-2 mb-1">
        <h2 class="border-b-2 border-blue-500 text-lg font-bold mb-2">投稿スラッグ</h2>
        <div class="">
          <input name="post_name" id="" class="px-2 py-2 border rounded w-full" value="{{ old('post_name', $post->post_name) }}"></input>
        </div>
      </div>

    </div>
  </div>
</form>

</div>
@endsection