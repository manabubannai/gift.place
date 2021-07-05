@extends('layouts.app', ['noContainer' => true])

@section('content')
<main class="p-user-user-show">
  <h1 class="page_title">マイページ</h1>
  <div class="mypage-info">
    <img src="{{ $user->cover_url }}" alt="" class="mypage-icon">
    <div class="mypage-info_container">
      <p class="mypage-name">{{ $user->name }}</p>
      <p class="mypage-id">@ {{ $user->slug }}</p>

      @if (Auth::user()->can('user-user-can-edit', $user))
        <a href="{{ route('user.users.edit', $user->slug) }}">設定・退会</a>
      @endif
    </div>
  </div>

  <message-index-card
    :is-user="true"
    :user-id="{{ json_encode($user->id) }}"></message-index-card>

</main>
@endsection
