<!-- <header class="s-header">
  <div class="flex_sb align_center">
    <div>
      @guest
        <a href="/">
          <img src="https://files.gift.place/images/logo_gift_village.png" alt="ギフト村" class="s-header__img">
        </a>
      @else
        <a href="{{ route('user.dashboard') }}">
          <img src="https://files.gift.place/images/logo_gift_village.png" alt="ギフト村" class="s-header__img">
        </a>
      @endif
    </div>

    <nav class="s-header__nav">
      <ul class="s-header__nav--ul">
        @guest
          <li><a href="#about" class="s-header__nav-link">ギフト村とは<span>What's gift village?</span></a></li>
          <li><a href="#cost" class="s-header__nav-link">利用料金<span>How much does it cost?</span></a></li>
          <li><a href="{{ route('user.dashboard') }}" class="s-header__nav-link">みんなの投稿<span>Villager’s gifts</span></a></li>
          <li><a href="{{ route('user.messages.create', null, false) }}" class="s-header__nav--btn m-btn">投稿する</a></li>
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
          <li><a href="{{ route('user.dashboard') }}" class="s-header__nav-link">みんなの投稿<span>Villager’s gifts</span></a></li>
          <li><a href="{{ route('user.messages.create', null, false) }}" class="s-header__nav--btn m-btn">投稿する</a></li>
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
</header> -->

<header class="s-header">
  <div class="flex_sb align_center header-pc">
    <div><a href="/"><img src="https://files.gift.place/images/logo_gift_village.png" alt="ギフト村" class="header_img"></a></div>

    <nav class="header_nav">
      <ul class="header_nav--ul">
        <li><a href="/mypage.html" class="header_nav-link">マイページ<span>My page</span></a></li>
        <li><a href="/messages.html" class="header_nav-link">みんなの投稿<span>Villager’s gifts</span></a></li>
        <li><a href="#2" class="header_nav-link">ログアウト<span>Logout</span></a></li>
        <li><a href="/mypage.html" class="header_nav-bell"><img src="/img/bell-off.svg" alt=""></a></li>
        <li><a href="/post.html" class="header_nav--btn btn">投稿する</a></li>
      </ul>
    </nav>
  </div>

  <div class="header-sp">
    <div class="flex_sb ">
      <div class="header-sp_logos">
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="header-sp-img"><a href="/"><img src="https://files.gift.place/images/logo_gift_village.png" alt="ギフト村"
              class="header_img"></a></div>
      </div>
      <div class="header-sp-nav">
        <ul class="header_nav--ul">
          <li><a href="/mypage.html" class="header_nav-bell"><img src="https://files.gift.place/images//bell-off.svg" alt=""></a></li>
          <li><a href="/post.html" class="header_nav--btn btn">投稿する</a></li>
        </ul>
      </div>
    </div>
  </div>

  <nav class="globalMenuSp ta-left">
    <ul>
      <li>
        <a href="/mypage.html" class="header_nav-flex">
          <img src="https://files.gift.place/images/toukou_img.png" alt="" class="post-icon">
          <div class="post-txtbox">
            <p class="header-name">名前</p>
            <p class="header-id">@megumi_design</p>
          </div>
        </a>
      </li>
      <li class="header_udnav-link"><a href="/mypage.html">マイページ</a></li>
      <li class="header_udnav-link"><a href="/messages.html">みんなの投稿</a></li>
      <li class="header_udnav-link"><a href="#">ログアウト</a></li>
    </ul>
  </nav>
</header>