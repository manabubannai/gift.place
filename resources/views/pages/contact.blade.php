@extends('layouts.app')

@section('content')
    <div class="p-contact">

      <section class="page">
        <h1 class="page_title">お問い合わせ</h1>
        <form action="https://api.staticforms.xyz/submit" method="post" >
          <div class="p-contact__form">
            <div class="p-contact__form--flex">
              <div class="p-contact__form--txt">お名前</div>
              <div class="p-contact__form--input">
                <input type="text" name="name" class="p-contact__form--text">
              </div>
            </div>
            <div class="p-contact__form--flex">
              <div class="p-contact__form--txt">メールアドレス</div>
              <div class="p-contact__form--input">
                <input type="text" name="email" class="p-contact__form--text">
              </div>
            </div>
            <div class="p-contact__form--flex">
              <div class="p-contact__form--txt">メッセージ</div>
              <div class="p-contact__form--input">
                <textarea name="message" class="p-contact__form--message" rows="5"></textarea>
              </div>
            </div>
          </div>
          <input type="submit" value="送信する" class="p-contact__form--submit">
        </form>
      </section>

    </div>
@endsection
