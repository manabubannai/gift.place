@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-subscription">
      <div class="settlement">

        <h1 class="page_title">カードを変更する</h1>
        <!-- <p>{{ $paymentMethod->card->brand }}</p>
        <p>{{ $paymentMethod->card->last4 }}</p> -->
        @php
            $isShow = false;
        @endphp

        <stripe-card-form
        :title="`変更する`"
        :is-show="{{ json_encode($isShow) }}"
        :route="{{ json_encode(route('user.subscriptions.card.change')) }}"
        :public-key="{{ json_encode(config('services.stripe.key')) }}"
        :client-secret="{{ json_encode($intent->client_secret) }}"></stripe-card-form>
      </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/stripe.js') }}"></script>
@endsection