@extends('_includes._layout')

@section('content')
<div class="container">
  <h1 class="mb-4">メッセージ一覧</h1>

  <p class="mb-4"><a class="btn-blue" href="{{ route('admin.message.create') }}">メッセージ新規作成</a></p>

  <table border="1">
    <tr class="border-b">
      <td>変更</td>
      <td>誰宛</td>
      <td>タイトル</td>
      <td>本文</td>
    </tr>
  @foreach($messages as $message)
    <tr class="border-b">
      <td><a href="{{ route('admin.message.edit', $message->id) }}">変更</a></td>
      <td>{{ $message->user->name }}</td>
      <td>{{ $message->title }}</td>
      <td>{{ Str::limit($message->content, 50) }}</td>
    </tr>
  @endforeach
  </table>

</div>
@endsection