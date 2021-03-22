<div class="c-message-index-card">
    <div class="post-flex">
      <a href="/mypage.html" class="post-face">
        <img src="/img/toukou_img.png" alt="" class="post-icon">
      </a>
      <div class="post-txtbox">
        <a href="/mypage.html" class="postpage-name">
          <p>{{ $message->user->name }}</p>
        </a>
        <p class="post-txt">
          {!! $message->description !!}
        </p>
        <div class="flex_sb">
          <div class="heart-toggle"></div>
          <p class="post-time">
            {{ $message->created_at }}
            <!-- PM23時55分2021年2月1日 -->
          </p>
        </div>
      </div>
    </div>
</div>

  <!-- <div class="c-user-job-index-card--right">

    <div class="c-user-job-index-card--desc">
      @if(!empty($message->description))
        <p class="c-user-job-index-card--desc-p">
          {!! $message->description !!}
        </p>
      @endif
    </div>

    <div class="c-user-job-index-card__btn--wrap">
      <a href="{{ route('user.messages.show', $message->uuid) }}" class="w-100 m-btnM" btn-type="primary">
        詳しく見る
      </a>
    </div>
  </div>

</div>
 -->