@extends('_includes._layout')

@section('content')

<section class="l-index">

    <form method="POST">
        @csrf
        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_PUB_KEY') }}"
                data-amount="500"
                data-name="ストライプ デモ"
                data-description="有料記事「記事タイトル」の購入"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="jpy">
        </script>
    </form>

</section>

@endsection