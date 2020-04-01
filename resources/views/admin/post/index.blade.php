@extends('_includes._l-admin')

@section('jsAction', 'adminIndex')
@section('admin__title', '投稿一覧')

@section('link-button')
  <a class="button" href="/admin/post/create">新規追加</a>
@endsection

@section('admin__content')

<form class="confirm checkAll-wrapper" method="POST" action="/admin/post/delete">
  @csrf
  @method('DELETE')

  <button class="button__inverse admin__index-batchSubmit batchSubmit" type="submit" name="checked" value="checked">一括削除</button>

  <table class="admin__index-table">
    <tr>
      <th><input class="checkAll-trigger" type="checkbox"></th>
      <th>タイトル</th>
      <th class="overTablet">カテゴリー</th>
      <th class="overTablet">タグ</th>
      <th>日付</th>
      <th></th>
    </tr>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <td><input type="checkbox" name="checkedIds[]" value="{{ $post->id }}"></td>
        <td>
          {!! $post->for_subscriber == 1 ? '<i class="fas fa-lock"></i>' : '' !!}
          <a class="text-link" href="/admin/post/edit/{{ $post->post_name }}">{{ Str::limit($post->post_title, 50) }}</a>
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
          <a class="text-link" href="/admin/post/edit/{{ $post->post_name }}">編集</a>
          <span class="overTablet">|</span>
          <br class="forTablet">
          <button class="text-link" type="submit" name="deleteId" value="{{ $post->id }}">削除</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</form>

<div class="admin__index-pagination">
  {{ $posts->links() }}
</div>

@endsection