@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="">

        <stripe-card-form route="{{ route('user.card') }}"
                         public_key="{{ config('services.stripe.key') }}" method="POST"></stripe-card-form>
    </div>
@endsection
