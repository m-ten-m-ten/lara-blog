@extends('_includes._layout')

@section('content')

<div class="l-show">

  <div class="m-breadcrumb">
    <ul>
      <li><a class="text-link" href="{{ route('user.top') }}">トップ</a></li>
      <li><a class="text-link" href="{{ route('user.message.index') }}">メッセージ一覧</a></li>
      <li>詳細</li>
    </ul>
  </div>

  <div class="m-show-title">

    <h1 class="m-show-title-text">{{ $message->title }}</h1>

    <span class="m-show-title-date">{{ $message->created_at->format('Y.m.d') }}</span>

  </div>

  <div class="m-show-content">
    {!! nl2br(e($message->content)) !!}
  </div>

</div>

@endsection