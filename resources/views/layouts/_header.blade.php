<header class="s-header" style="position: sticky; top: 0; z-index: 9999;">
    <div class="s-header__container">

      <div class="s-header__content--left">
          <div class="s-header-logo">
              <a href="/" class="">
                  <img src="../images/frip_logo_color.png" class="s-header-logo__sizing">
              </a>
          </div>
      </div>

      <div class="s-header__content--right">

        <nav class="float-right s-header-list">
          @guest
              <a href="/getting-started" class="mr-2">はじめての方へ</a>
              <a href="{{ route('user.auth.login') }}" class="mr-2">無料会員登録/ログイン</a>
          @else
              <a href="{{ route('user.messages.create', null, false) }}" class="mr-2 m-btn" style="color: #fff;">投稿する</a>
                <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a href="{{ route('user.users.me') }}" class="dropdown-item">マイページ</a>
                    <a href="/getting-started" class="dropdown-item">はじめての方へ</a>
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
</header>
