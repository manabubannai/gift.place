@extends('layouts.app')

@section('content')
<div class="auth-register mx-auto w-100 py-4 pb-5">
<h3 class="text-center pb-3">ローカル開発のための認証画面</h2>
  <h5 class="title title-up text-center mb-3 font-weight-bold gray">新規登録</h5>
  <form method="POST" action="{{ route('post.localRegister') }}">
    @csrf

    <!-- login email -->
    <div class="row">
        <div class="form-label-group col-lg-8 mx-auto black font-weight-bold py-2">
            <!-- <label>名前</label> -->
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : (Session::get('callback_provider_user') ? Session::get('callback_provider_user')->getName() : '') }}" required autocomplete="name" autofocus placeholder="名前を入力してください">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group col-lg-8 mx-auto black font-weight-bold py-2">
            <!-- <label>メールアドレス</label> -->
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : (Session::get('callback_provider_user') ? Session::get('callback_provider_user')->getEmail() : '') }}" required autocomplete="email" placeholder="メールアドレスを入力してください">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="text-center">
      <button class="m-btn mx-auto col-md-4" type="submit">
        メールアドレスで新規登録
      </button>
    </div>
  </form>

  <hr>

  <h5 class="title title-up text-center mb-3 font-weight-bold gray">ログイン</h5>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="row p-3">
      <div class="form-label-group col-lg-6 font-weight-bold py-2">
        <!-- <label>メールアドレス</label> -->
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレスを入力してください">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class="form-label-group col-lg-6 font-weight-bold py-2">
        <!-- <label>パスワード</label> -->
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワードを入力してください">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>
    <div class="text-center">
      <button class="m-btn mx-auto col-md-4" type="submit">
        メールアドレスでログイン
      </button>
    </div>
  </form>
</div>
@endsection
