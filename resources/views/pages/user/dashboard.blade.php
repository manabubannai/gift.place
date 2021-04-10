@extends('layouts.app', ['noContainer' => true])

@section('content')
<div class="p-dashboard">

  <div class="post">
    <h1 class="page_title">みんなの投稿を見てみよう</h1>
    <!-- <div class="post-wrap"> -->
    <message-index-card
      :is-user="false"></message-index-card>

    <!-- </div> -->
  </div>
</div>

@endsection
