@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="">

      <p>{{ $paymentMethod->card->brand }}</p>
      <p>{{ $paymentMethod->card->last4 }}</p>

      <p>change card</p>

        <stripe-card-form
        :route="{{ json_encode(route('user.subscriptions.card.change')) }}"
        :public-key="{{ json_encode(config('services.stripe.key')) }}"
        :client-secret="{{ json_encode($intent->client_secret) }}"></stripe-card-form>
    </div>
@endsection
