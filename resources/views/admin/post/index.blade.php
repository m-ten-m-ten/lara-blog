@extends('_includes._layout')
@section('content')

<div class="l-admin-index">

  {{-- 管理者画面ヘッダー --}}
  <div class="m-admin-header">
    <div class="m-admin-header-left">
      <h1 class="m-admin-header-title">投稿一覧</h1>
      <a class="m-button" href="/admin/post/create">新規追加</a>
    </div>
  </div>

  {{-- 管理者画面メイン --}}

  @include('_includes._m-status')

  <form id="delete-form" method="POST" action="/admin/post/delete">
  @csrf
  @method('DELETE')

    <button id="multipleSubmitBtn" class="m-button--inverse m-admin-multiple-button" type="submit" name="checked" value="checked">一括削除</button>

    <table class="m-admin-table">
      <tr>
        <th><input type="checkbox" id="all"></th>
        <th>タイトル</th>
        <th class="overTablet">カテゴリー</th>
        <th class="overTablet">タグ</th>
        <th>日付</th>
        <th></th>
      </tr>
      <tbody id="boxes">
        @foreach ($posts as $post)
        <tr>
          <td><input type="checkbox" name="checkedIds[]" value="{{ $post->id }}"></td>
          <td>
            @if($post->for_subscriber == 1)
              <span class="m-index-postList-subscriber">[有料]</span>
            @endif
            <a class="text-link" href="/admin/post/edit/{{ $post->id }}">
            {{ $post->post_title }}</a>
            {{ $post->post_status == 'drafted' ? ' - 下書き' : ''}}
          </td>
          <td class="overTablet">{{ $post->category ? $post->category->category_title : ''}}</td>
          <td class="overTablet">
            @foreach ($post->tags as $tag)
              #{{ $tag->tag_title }}
            @endforeach
          </td>
          <td>
            {!! $post->post_published ? '公開日時：'.$post->post_published->format('Y/m/d H:i').'<br>' : '' !!}
            {!! $post->post_modified ? '更新日時：'.$post->post_modified->format('Y/m/d H:i').'<br>' : '' !!}
            {{ $post->post_status == 'drafted' ? '下書き：'.$post->post_drafted->format('Y/m/d H:i') : '' }}
          </td>
          <td class="nowrap">
            <a class="text-link" href="/admin/post/edit/{{ $post->id }}">編集</a>
            <span class="overTablet">|</span>
            <br class="forTablet">
            <button class="text-link" type="submit" name="deleteId" value="{{ $post->id }}">削除</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </form>

  <div class="m-admin-pagination">
    {{ $posts->links() }}
  </div>

</div>
@endsection