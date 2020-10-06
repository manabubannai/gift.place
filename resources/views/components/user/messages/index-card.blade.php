<div class="c-user-job-index-card">

  <div class="c-user-job-index-card--right">

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
