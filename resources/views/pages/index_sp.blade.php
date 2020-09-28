@extends('layouts.app', ['noContainer' => true])

@section('content')
<div id="p-index" class="p-index" style="position: absolute; top: 0; right: 0; left: 0; padding-bottom: 100px;">
    <!-- p-index--image -->
    <div class="p-index__image">
        <div class="text-center" style="padding-top: 70px;">
              <img src="../images/frip_logo2.png" class="s-header-logo__sizing" style="width: auto; height: 34px;">
        </div>
        <p class="p-index--copy">
            最高の海外旅行スポットに巡り会う旅行メディア
        </p>
      <div class="p-index__search-form text-center">
      </div>
    </div>

    <!-- p-index--new -->
    <section class="p-index--new">
        <header class="p-index--header">
            <h2 class="p-index--header__primary">新着の投稿</h2>
            <p class="p-index--header__medium-text">海外旅行の記録やレビューを残してみましょう。</p>
        </header>
        <hr>

        <div class="text-center">
            <a href="" class="m-btn" style="color: #fff;">もっとみる</a>
        </div>
    </section>

    <!-- p-index--spot--new -->
    <section class="p-index--spot--new">
        <header class="p-index--header">
            <h2 class="p-index--header__primary">新着の海外旅行スポット</h2>
            <p class="p-index--header__medium-text">みんなのおすすめ海外旅行スポットをみてみましょう。</p>
        </header>


        <div class="text-center">
            <a href="" class="m-btn" style="color: #fff;">もっとみる</a>
        </div>
    </section>

</div>
@endsection
