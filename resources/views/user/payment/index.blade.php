@extends('_includes._layout')
@section('content')

<div class="l-user-index">

  {{-- ユーザー画面ヘッダー --}}
  <div class="m-user-header">
    <h1 class="m-user-header-title">お支払い情報</h1>
  </div>

  @include('_includes._m-status')
  @include('_includes._m-error')

  <div class="m-user-main">

    <div class="m-user-main-section">

      <h2>会員種別：<span class="text-blue">{{ $user->status == 0 ? '無料会員' : '有料会員' }}</span></h2>

      @if($defaultCard)

        @if($user->status == 0)
          <p>1,000円/月で有料会員となり、全ての記事を購読できるようになります。</p>
          <form action="{{ route('user.subscribe.create') }}" method="POST">
            @csrf
            <button type="submit" class="m-button">有料会員になる</button>
          </form>
        @else
          <p>下記ボタンを押すことで、有料会員を解約することができます。</p>
          <form action="{{ route('user.subscribe.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="m-button--red">有料会員を解除する</button>
          </form>
        @endif

      @else
        <p>有料会員登録をするためには、下記よりお支払い用のクレジットカードをご登録下さい。</p>
      @endif

    </div>

    <div class="m-user-main-section">

      <h2>クレジットカード登録状況</h2>

      @isset($defaultCard)
        <table class="mt10 mb10">
          <tr>
            <td>カード番号</td>
            <td>{{ $defaultCard["number"] }}</td>
          </tr>
          <tr>
            <td>有効期限（月/年)</td>
            <td>{{ $defaultCard["exp_month"] }}/{{ $defaultCard["exp_year"] }}</td>
          </tr>
          <tr>
            <td>カード名義</td>
            <td>{{ $defaultCard["name"] }}</td>
          </tr>
          <tr>
            <td>カードブランド</td>
            <td>{{ $defaultCard["brand"] }}</td>
          </tr>
        </table>
      @else
      <p>現在登録されているクレジットカードはありません。</p>
      @endif

      @isset($defaultCard)
        <a class="text-link" href="{{route('user.payment.create')}}" >クレジットカードを変更</a>

        <form id="delete-form" action="/user/payment/delete" method="POST">
          @csrf
          @method('DELETE')
          <button class="m-button--red mt10">クレジットカードを削除</button>
        </form>
      @else
        <a href="{{route('user.payment.create')}}" class="text-link">クレジットカードを登録</a>
      @endif

    </div>

  </div>

</div>

@endsection