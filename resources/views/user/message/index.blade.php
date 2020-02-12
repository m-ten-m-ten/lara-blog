@extends('_includes._l-user')
@section('user-title', 'メッセージ一覧')
@section('user-content')

<div class="message">
  <ul class="message__list">
    @foreach($messages as $message)
    <li class="message__list-item accordion-wrapper">
      <div class="message__list-title accordion-trigger">
        <span class="message__list-date">{{ $message->created_at->format('Y.m.d') }}</span>{{ $message->title }}
      </div>
      <div class="message__list-body accordion-body">{{ $message->content }}</div>
    </li>
    @endforeach
  </ul>
</div>

@endsection