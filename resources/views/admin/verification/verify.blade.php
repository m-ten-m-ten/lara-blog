@extends('_includes._l-form')
@section('title', 'メール送信完了')
@section('form-content')

@if (session('resent'))
  <p>ご登録頂きましたメールアドレスに、新しい確認用のメールが送信されました。</p>
@else
  <p>ご登録頂きましたメールアドレスに、確認用のメールが送信されました。</p>
@endif

<p>メールをご確認のうえ、メールの記載内容の通り、メールアドレスを有効化し、登録を完了させて下さい。</p>

<p>メールが届かない場合、下記より再度送信してください。</p>

<form method="POST" action="{{ route('admin.verification.resend') }}">
  @csrf
  <input type="submit" class="button" value="確認用メールを再送信する">
</form>

@endsection