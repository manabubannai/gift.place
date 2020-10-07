@extends('layouts.app')

@section('content')
<div class="container pb-24 min-h-screen">
  <div class="w-4/6 mx-auto">

    <form action="{{ route('user.auth.store.email') }}" method="POST">
      @csrf

      <h2 class="text-center mt-16 mb-4">
        E-MAILを入力
      </h2>
        <label for="email" class="c-label">E-MAIL</label>
        <input id="email" type="email" class="w-full c-input__text mb-4" name="email" value="{{ old('email') ? old('email') : (Session::get('callback_provider_user') ? Session::get('callback_provider_user')->getEmail() : '') }}" required autocomplete="email" placeholder="メールアドレスを入力してください">

        <button
          class="c-button c-button--01 mt-6 js-accent-bg" type="submit">
          REGISTER
        </button>
    </form>
  </div>
</div>
@endsection
