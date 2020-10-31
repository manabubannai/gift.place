@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="">

        <p class="text-center">決済page 月額390</p>

        @if(!is_null($paymentMethod))
          <form action="{{ route('user.subscriptions.create') }}" method="POST">
            @csrf
            <input type="radio" name="payment_method" id="{{ $paymentMethod->id }}"
                   value="{{ $paymentMethod->id }}"checked="checked">
            <label class="justify-content-between d-flex" for="{{ $paymentMethod->id }}">
                <span class="brand mx-1">{{ $paymentMethod->card->brand }}</span>
                <span class="number mx-1">**** **** **** {{ $paymentMethod->card->last4 }}</span>
                <span class="exp mx-1">{{ $paymentMethod->card->exp_month }}<span
                        class="separator mx-1">/</span>{{ $paymentMethod->card->exp_year }}</span>
            </label>

            <button type="submit" class="m-btn">ご登録済みのカードで再入会する</button>
          </form>
        @endif


        <stripe-card-form
        :route="{{ json_encode(route('user.subscriptions.create')) }}"
        :public-key="{{ json_encode(config('services.stripe.key')) }}"
        :client-secret="{{ json_encode($intent->client_secret) }}"></stripe-card-form>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/stripe.js') }}"></script>
@endsection