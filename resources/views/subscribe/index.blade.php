@extends('_includes._layout')

@section('content')

<section class="l-index">

{{ $user->id }}

    <form class="mt10" method="POST">
        @csrf
        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ env('STRIPE_PUB_KEY') }}"
                data-amount="1000"
                data-name="Subscribe デモ"
                data-description="有料会員登録（定期支払い）"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="jpy">
        </script>
    </form>

</section>

@endsection