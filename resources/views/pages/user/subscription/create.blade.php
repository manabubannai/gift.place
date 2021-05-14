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
                        <input type="checkbox" name="payment_method" value="{{ $paymentMethod->id }}" required checked="checked">
                        <span class="brand mx-1">{{ $paymentMethod->card->brand }}</span>
                        <span class="number mx-1">**** **** **** {{ $paymentMethod->card->last4 }}</span>
                        <span class="exp mx-1">{{ $paymentMethod->card->exp_month }}<span
                                class="separator mx-1">/</span>{{ $paymentMethod->card->exp_year }}</span>
                    </label>
                </div>

                <p style="margin-top: 8px;">
                    以﻿下﻿のチ﻿ェ﻿ッ﻿クボ﻿ッ﻿ク﻿ス﻿をチ﻿ェ﻿ッ﻿クす﻿るこ﻿と﻿によ﻿り﻿、<a href="{{ route('term') }}" target="__blank">利﻿用規﻿約</a>お﻿よ﻿び<a href="{{ route('policy') }}"target="__blank">プライバシーポリシー</a>﻿に同﻿意す﻿るも﻿の﻿とし﻿ま﻿す﻿。キ﻿ャ﻿ン﻿セ﻿ルす﻿る﻿ま﻿で月﻿額メ﻿ン﻿バ﻿ー﻿シ﻿ッ﻿プ料﻿金 (現﻿在￥390)﻿ ﻿は﻿、ご﻿指﻿定﻿のお﻿支﻿払﻿い方﻿法に﻿て自﻿動引﻿き落﻿と﻿しさ﻿れ﻿ま﻿す﻿。お﻿好﻿き﻿なと﻿き﻿にキ﻿ャ﻿ン﻿セ﻿ルし﻿てい﻿た﻿だ﻿け﻿れ﻿ば﻿、そ﻿れ以﻿降﻿は料﻿金﻿を請﻿求さ﻿れ﻿るこ﻿と﻿はあ﻿り﻿ま﻿せ﻿ん﻿。
                </p>

                <div class="settlement-check_container">
                    <label class="settlement-check">
                        <input type="checkbox" id="card-check" required />同意する
                    </label>
                </div>

                <button type="submit" class="m-btn">ご登録済みのカードで再入会する</button>
              </form>
            @endif

            @if(is_null($paymentMethod))
                <stripe-card-form
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