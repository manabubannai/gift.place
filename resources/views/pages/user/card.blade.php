@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="">

        <stripe-card-form
        :route="{{ json_encode(route('user.card')) }}"
        :public-key="{{ json_encode(config('services.stripe.key')) }}"
        :client-secret="{{ json_encode($intent->client_secret) }}"
        :method="POST"></stripe-card-form>
    </div>
@endsection
