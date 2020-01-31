@extends('_includes._layout')
@section('content')

<div class="l-user-index">

  @include('_includes._m-user-header', ['title' => 'メッセージ一覧'])

  @include('_includes._m-status')
  @include('_includes._m-error')

  <div class="m-user-main">

    <div class="m-user-main-section">

      <table class="m-message">

        <tr>
          <th>登録日</th>
          <th>タイトル(詳細へ)</th>
          <th class="overTablet">本文</th>
        </tr>

        @foreach($messages as $message)
        <tr>
          <td>{{ $message->created_at->format('Y.m.d') }}</td>
          <td><a class="text-link" href="{{ route('user.message.show', $message->id) }}">{{ $message->title }}</a></td>
          <td class="overTablet">{{ Str::limit($message->content, 50) }}</td>
        </tr>
        @endforeach

      </table>

    </div>

  </div>

</div>
@endsection