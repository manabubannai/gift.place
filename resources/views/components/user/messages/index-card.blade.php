<div class="c-message-index-card">
  <div class="post-flex">
    <a href="{{ route('user.users.show', $message->user->slug) }}" class="post-face">
      <img src="{{ $message->user->cover_url }}" alt="" class="post-icon">
    </a>
    <div class="post-txtbox">
      <a href="{{ route('user.users.show', $message->user->slug) }}" class="postpage-name">
        <p>{{ $message->user->name }}</p>
      </a>
      <a href="{{ route('user.messages.show', $message->uuid) }}" style="display: block;">
        <p class="post-txt">
          {!! $message->description !!}
          <!-- {{ $message->description }} -->
        </p>
        <div class="flex_sb">
          <!-- <div class="heart-toggle"></div> -->
          <p class="post-time">
            {{ $message->created_at_jst }}
            <!-- PM23時55分2021年2月1日 -->
          </p>
        </div>
      </a>
    </div>
  </div>
</div>
