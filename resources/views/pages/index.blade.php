@extends('layouts.app')

@section('content')
    <div id="p-index" class="p-index">
        <!-- <div class="p-index__image">
          <p class="p-index--copy">ギフト村</p>
          <div class="p-index__search-form text-center">
            <a class="m-btn" btn-type="twitter" href="{{ route('user.auth.redirect.provider', 'twitter') }}" style="text-decoration: none;">
                    <div class="col-1"><i class="fab fa-twitter-square"></i></div>
                    <div class="col-11 text-left"><p>Twitterで登録・ログイン</p></div>
            </a>
          </div>
        </div>

        <section class="p-index--new">
            <div class="container py-4">
                <header class="c-heading">
                    <h2 class="c-heading__big">
                        <span class="c-heading__string">hoge</span>
                    </h2>
                </header>
                <p class="pb-4">感謝を残してみましょう。</p>
                

                <div class="text-center">
                    <a href="" class="m-btn" style="color: #fff;">もっとみる</a>
                </div>
            </div>
        </section> -->

        <main class="p-index__main">
          <h1 class="p-index__main_title">ギフト村</h1>
          <p class="p-index__main_text">1日1回、出会った人に感謝しよう。</p>
          <a href="{{ route('user.auth.redirect.provider', 'twitter') }}" class="m-btn" btn-type="main">ギフト村に入る</a>
        </main>

        <section class="p-index__gift" id="about">
          <h2 class="p-index__sub_title p-index__gift_title">ギフト村とは</h2>
          <p class="p-index__sub_text">寝る前にギフト（＝感謝）を投稿して、<br class="br_hide">幸福度を高めるサービスです</p>
          <div class="flex_sb">
            <div class="p-index__gift_content--item">
              <img src="../images/img_5.png" alt="出会った人に感謝しよう" class="p-index__gift_content--img">
              <p class="p-index__gift_content--text">１日１回、出会った人に感謝することであなたの幸福度を高めることができます。直接本人に伝えることが出来なくても、想いを抱くことが大切です。</p>
            </div>
            <div class="p-index__gift_content--item">
              <img src="../images/img_6.png" alt="感謝のパワーを獲得しよう" class="p-index__gift_content--img">
              <p class="p-index__gift_content--text">寝る前などに感謝の投稿をすることで上記５項目の効果が期待されます。体感でも効果を感じますし、科学的にも実証されています。</p>
            </div>
            <div class="p-index__gift_content--item">
              <img src="../images/img_7.png" alt="売上の50％は寄付します" class="p-index__gift_content--img">
              <p class="gift_content--text">ギフト村の売上の５０％を慈善団体に寄付します。寄付先や寄付額などの内訳につきましては毎月末ギフト村にて公開いたします。</p>
            </div>
          </div>
        </section>

        <section class="p-index__cost" id="cost">
          <h2 class="p-index__sub_title p-index__cost_title">利用料金</h2>
          <p class="p-index__sub_text">感謝の気持ちを込めてサンキュー価格にしております</p>
           <div class="p-index__cost_cntent">
            <img src="../images/contents_2.png" alt="月額390円" class="p-index__cost_cntent--img">
            <p class="p-index__cost_cntent--text">※慈善団体に一部<br class="br_pc">寄付されます。</p>
           </div>

           <div class="twitter">
            <p class="twitter_txt">Twitterログインで「ギフト村」に参加できます</p>
            <p><a href="#" class="m-btn" btn-type="twitter"><img src="../images/twi_logo.png" alt="twiter_logo" class="twitter_btn--logo"> Twitterで登録する</a></p>
           </div>
        </section>

    </div>
@endsection
