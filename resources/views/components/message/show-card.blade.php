<main class="c-message-show-card">
    <article>
        <!-- 投稿完了 -->
        <div>
            <div class="c-message-show-card-post popup">
                <section class="c-message-show-card-post_content">
                    <div class="c-message-show-card-flex">
                        <img src="{{ $message->user->cover_url }}" alt="" class="c-message-show-card-post_icon">
                        <p class="post-name">{{ $message->user->name }}</p>
                    </div>
                    <p class="c-message-show-card-txt">
                        {!! nl2br(e($message->description)) !!}
                    </p>
                </section>
            </div>
        </div>
    </article>
</main>