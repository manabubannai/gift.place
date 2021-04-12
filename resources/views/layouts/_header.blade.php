<header class="s-header">
  <div class="flex_sb align_center header-pc">
    <div>
      @guest
        <a href="/"><img src="https://files.gift.place/images/logo_gift_village.png" alt="ギフト村" class="header_img"></a>
      @else
        <a href="{{ route('user.dashboard') }}"><img src="https://files.gift.place/images/logo_gift_village.png" alt="ギフト村" class="header_img"></a>
      @endguest
    </div>

    <nav class="header_nav">
      <ul class="header_nav--ul">
        @guest
          <li><a href="#about" class="header_nav-link">ギフト村とは<span>What's gift village?</span></a></li>
          <li><a href="#cost" class="header_nav-link">利用料金<span>How much does it cost?</span></a></li>
          <li><a href="{{ route('user.dashboard') }}" class="header_nav-link">みんなの投稿<span>Villager’s gifts</span></a></li>
          <li><a href="{{ route('user.messages.create', null, false) }}" class="header_nav--btn m-btn">投稿する</a></li>
        @else
          <li><a href="{{ route('user.users.show', \Auth::user()->slug) }}" class="header_nav-link">マイページ</li>
          <li><a href="{{ route('user.dashboard') }}" class="header_nav-link">みんなの投稿<span>Villager’s gifts</span></a></li>
          <li><a href="{{ route('user.messages.create', null, false) }}" class="header_nav--btn btn">投稿する</a></li>
          <li><a class="header_nav-link" href="{{ route('user.auth.logout') }}"
                       onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">ログアウト</a></li>

          <form id="logout-form" action="{{ route('user.auth.logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        @endif

      </ul>
    </nav>
  </div>

  <div class="header-sp">
    <div class="flex_sb ">
      <div class="header-sp_logos">
        @auth
          <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        @endauth
        <div class="header-sp-img">
          @guest
            <a href="/">
              <img src="https://files.gift.place/images/logo_gift_village.png" alt="ギフト村"
                class="header_img">
            </a>
          @else
            <a href="{{ route('user.dashboard') }}">
              <img src="https://files.gift.place/images/logo_gift_village.png" alt="ギフト村"
                class="header_img">
            </a>
          @endif
        </div>
      </div>
      <div class="header-sp-nav">
        <ul class="header_nav--ul">
          @guest
          @else
            <li><a href="{{ route('user.users.show', \Auth::user()->slug) }}" class="header_nav-bell"><img src="https://files.gift.place/images//bell-off.svg" alt=""></a></li>
            <li><a href="{{ route('user.messages.create', null, false) }}" class="header_nav--btn btn">投稿する</a></li>
          @endif
        </ul>
      </div>
    </div>
  </div>

  <nav class="globalMenuSp ta-left">
    <ul>
      @guest
      @else
        <li>
          <a href="{{ route('user.users.show', \Auth::user()->slug) }}" class="header_nav-flex">
            <img src="{{ \Auth::user()->cover_url }}" alt="" class="post-icon">
            <div class="post-txtbox">
              <p class="header-name">{{ \Auth::user()->name }}</p>
              <p class="header-id">@ {{ \Auth::user()->slug }}</p>
            </div>
          </a>
        </li>
        <li class="header_udnav-link"><a href="{{ route('user.users.show', \Auth::user()->slug) }}">マイページ</a></li>
        <li class="header_udnav-link"><a href="{{ route('user.dashboard') }}">みんなの投稿</a></li>

        <li><a class="header_udnav-link" href="{{ route('user.auth.logout') }}"
                         onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">ログアウト</a></li>
        <form id="logout-form" action="{{ route('user.auth.logout') }}" method="POST" style="display: none;">
              @csrf
        </form>
      @endif
    </ul>
  </nav>
</header>