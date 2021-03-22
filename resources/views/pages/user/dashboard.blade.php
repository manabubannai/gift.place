@extends('layouts.app', ['noContainer' => true])

@section('content')
<div class="p-dashboard">

  <div class="post">
    <h1 class="page_title">みんなの投稿を見てみよう</h1>
    <div class="post-wrap">

      @each('components.user.messages.index-card', $messages, 'message' ,'pages.user.messages.empty')

      {{ $messages->links('components.pagination.default') }}
    </div>
  </div>
</div>
@endsection
