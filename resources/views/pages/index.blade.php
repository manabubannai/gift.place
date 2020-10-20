@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div id="p-index" class="p-index">
        <!-- p-index--image -->
        <div class="p-index__image">
          <p class="p-index--copy">ギフト村</p>
          <div class="p-index__search-form text-center">
            <a href="" class="" style="text-decoration: none;">
              <button class="m-btn" style="width: 280px; height: 60px;">登録する</button>
            </a>
          </div>
        </div>

        <!-- p-index--new -->
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
        </section>

    </div>
@endsection
