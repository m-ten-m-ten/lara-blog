@extends('_includes._l-form--center')

@section('title', 'クレジットカード登録')

@section('form-content')

@include('_includes._m-error')

<p>現在テスト中につき、下記のテスト用クレジットカードをご登録下さい。（請求はされません）</p>
<ul class="mb10">
  <li>カード番号：</li>
    <ul>
      <li>・4242424242424242(Visa)</li>
      <li>・5555555555554444(Mastercard)</li>
      <li>・3566002020360505(JCB)</li>
    </ul>
  <li>セキュリティコード：3桁の数字</li>
  <li>有効期限：未来の年月</li>
  <li>カード名義：ご自由にご入力下さい。</li>
</ul>

<form id="form_payment" class="mb10" method="POST">
  @csrf

<ul>
  <li class="m-form-row">
    <label class="m-form-title">カード番号</label>
    <div id="cardNumber"></div>
  </li>

  <li class="m-form-row">
    <label class="m-form-title">セキュリティコード</label>
    <div id="securityCode"></div>
  </li>

  <li class="m-form-row">
    <label class="m-form-title">有効期限</label>
    <div id="expiration"></div>
  </li>

  <li class="m-form-row">
    <label class="m-form-title">カード名義</label>
    <input type="text" name="cardName" id="cardName" class="m-form-input" value="" placeholder="カード名義を入力">
  </li>
</ul>

<button type="submit" id="create_token" class="m-button mt10">カードを登録する</button>

</form>

<a class="text-link" href="{{route('user.payment.top')}}">お支払い情報ページへ</a>

</section>

@endsection