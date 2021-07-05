@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-subscription">
        <div class="settlement">
            <h1 class="page_title">決済情報（月額390円）</h1>

            @if(!is_null($paymentMethod))

              <form action="{{ route('user.subscriptions.create') }}" method="POST" class="settlement-form">
                @csrf

                <div class="settlement-check_container">
                    <label class="settlement-check">
                        <input type="hidden" name="payment_method" value="{{ $paymentMethod->id }}">

                        <span class="brand mx-1">{{ $paymentMethod->card->brand }}</span>
                        <span class="number mx-1">**** **** **** {{ $paymentMethod->card->last4 }}</span>
                        <span class="exp mx-1">{{ $paymentMethod->card->exp_month }}<span
                                class="separator mx-1">/</span>{{ $paymentMethod->card->exp_year }}</span>
                    </label>
                </div>

                <p style="margin-top: 8px;">
                    以下のチェックボックスをチェックすることにより、<a href="{{ route('term') }}" target="__blank">利用規約</a>および<a href="{{ route('policy') }}"target="__blank">プライバシーポリシー</a>に同意するものとします。キャンセルするまで月額メンバーシップ料金 (現在￥390) は、ご指定のお支払い方法にて自動引き落としされます。お好きなときにキャンセルしていただければ、それ以降は料金を請求されることはありません。
                </p>

                <div class="settlement-check_container">
                    <label class="settlement-check">
                        <input type="checkbox" id="card-check" required />同意する
                    </label>
                </div>

                <button type="submit" class="submit-btn">ご登録済みのカードで再入会する</button>
              </form>
            @endif

            @php
                $isShow = true;
            @endphp
            @if(is_null($paymentMethod))
                <stripe-card-form
                :title="`入会する`"
                :is-show="{{ json_encode($isShow) }}"
                :route="{{ json_encode(route('user.subscriptions.create')) }}"
                :public-key="{{ json_encode(config('services.stripe.key')) }}"
                :client-secret="{{ json_encode($intent->client_secret) }}"></stripe-card-form>
            @endif
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/stripe.js') }}"></script>
@endsection