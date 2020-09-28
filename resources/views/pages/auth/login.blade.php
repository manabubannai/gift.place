@extends('layouts.app')

@section('content')
<div class="auth-login mx-auto w-100 py-4 pb-5 mb-5 pt-5 mt-5">
    <h5 class="title title-up text-center mb-3 font-weight-bold gray">無料会員登録/ログイン</h5>
    <div class="text-center pb-3 pt-3">
        <div class="col-12 mb-2">
            <a class="m-btn" btn-type="twitter" href="{{ url('login/twitter')}}" style="text-decoration: none;">
                <div class="col-1"><i class="fab fa-twitter-square"></i></div>
                <div class="col-11 text-left"><p>Facebookで登録・ログイン</p></div>
            </a>
        </div>
    </div>

    <div style="font-size: 11px;">
      <small class="gray">
          ※新規登録完了時点で<a href="" target="_blank">利用規約</a>、<a href="" target="_blank">プライバシーポリシー</a>に同意し、電子メールによる{{ config('app.name') }}からの情報提供を希望されたものとみなします。
      </small>
    </div>
</div>
@endsection
