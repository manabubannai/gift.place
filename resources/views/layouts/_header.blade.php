<!-- <header class="s-header" style="position: sticky; top: 0; z-index: 9999;">
    <div class="s-header__container">

      <div class="s-header__content--left">
          <div class="s-header-logo">
              @guest
                <a href="/" class="">
                    <img src="../images/frip_logo_color.png" class="s-header-logo__sizing">
                </a>
              @else
                <a href="{{ route('user.dashboard') }}" class="">
                  <img src="../images/frip_logo_color.png" class="s-header-logo__sizing">
                </a>
              @endif
          </div>
      </div>

      <div class="s-header__content--right">

        <nav class="float-right s-header-list">
          @guest
              <a href="/getting-started" class="mr-2">はじめての方へ</a>
          @else
              <a href="{{ route('user.messages.create', null, false) }}" class="mr-2 m-btn" style="color: #fff;">投稿する</a>
                <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a href="/getting-started" class="dropdown-item">はじめての方へ</a>
                    <a href="{{ route('user.users.show', \Auth::user()->slug) }}" class="dropdown-item">マイページ</a>

                    <a href="{{ route('user.subscriptions.card.change.form') }}" class="dropdown-item">カードを変更</a>

                    <a href="{{ route('user.users.destroy.form', \Auth::user()->slug) }}" class="dropdown-item">退会する</a>

                    <a class="dropdown-item" href="{{ route('user.auth.logout') }}"
                       onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                        <small>ログアウト</small>
                    </a>

                    <form id="logout-form" action="{{ route('user.auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
          @endif
        </nav>
      </div>
    </div>
</header> -->

<header class="s-header">
  <div class="flex_sb align_center">
    <div><a href="/"><img src="../images/logo_gift_village.png" alt="ギフト村" class="s-header__img"></a></div>

    <nav class="s-header__nav">
      <ul class="s-header__nav--ul">
        @guest
          <li><a href="#about" class="s-header__nav-link">ギフト村とは<span>What's gift village?</span></a></li>
          <li><a href="#cost" class="s-header__nav-link">利用料金<span>How much does it cost?</span></a></li>
        @else

        <li><a href="{{ route('user.dashboard') }}" class="s-header__nav-link">みんなの投稿<span>Villager’s gifts</span></a></li>

          <li><a href="{{ route('user.users.show', \Auth::user()->slug) }}" class="s-header__nav-link">マイページ</li>
          
          <li><a href="{{ route('user.messages.create', null, false) }}" class="s-header__nav--btn m-btn">投稿する</a></li>
          <li><a class="s-header__nav-link" href="{{ route('user.auth.logout') }}"
                       onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">ログアウト</a></li>

          <form id="logout-form" action="{{ route('user.auth.logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        @endif
      </ul>
    </nav>

    <div class="m-hamburger">
      <span class="m-hamburger__line"></span>
      <span class="m-hamburger__line"></span>
      <span class="m-hamburger__line"></span>
    </div>
    <nav class="globalMenuSp">
      <ul>
        @guest
          <li><a href="#about" class="s-header__nav-link">ギフト村とは<span>What's gift village?</span></a></li>
          <li><a href="#cost" class="s-header__nav-link">利用料金<span>How much does it cost?</span></a></li>
        @else
          <li><a href="{{ route('user.users.show', \Auth::user()->slug) }}" class="s-header__nav-link">マイページ</li>
          <li><a href="{{ route('user.dashboard') }}" class="s-header__nav-link">みんなの投稿<span>Villager’s gifts</span></a></li>
          <li><a href="{{ route('user.messages.create', null, false) }}" class="s-header__nav--btn m-btn">投稿する</a></li>
          <li><a class="s-header__nav-link" href="{{ route('user.auth.logout') }}"
                       onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">ログアウト</a></li>

          <form id="logout-form" action="{{ route('user.auth.logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        @endif
      </ul>
    </nav>
  </div>
</header>