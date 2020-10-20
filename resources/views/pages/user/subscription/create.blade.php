@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="">

        <p class="text-center">決済page 月額390</p>

        <stripe-card-form
        :route="{{ json_encode(route('user.subscriptions.create')) }}"
        :public-key="{{ json_encode(config('services.stripe.key')) }}"
        :client-secret="{{ json_encode($intent->client_secret) }}"
        :method="POST"></stripe-card-form>
    </div>
@endsection
