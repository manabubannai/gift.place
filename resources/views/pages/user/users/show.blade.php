@extends('layouts.app', ['noContainer' => true])

@section('content')
<main class="p-user-user-show">
  <h1 class="page_title">マイページ</h1>
  <div class="mypage-info">
    <img src="/img/toukou_img.png" alt="" class="mypage-icon">
    <div class="mypage-info_container">
      <p class="mypage-name">{{ $user->name }}</p>
      <p class="mypage-id">@ {{ $user->slug }}</p>

      @if (Auth::user()->can('user-user-can-edit', $user))
        <a href="{{ route('user.users.edit', $user->slug) }}">edit</a>
      @endif
    </div>
  </div>

  @each('components.user.messages.index-card', $user->messages, 'message' ,'pages.user.messages.empty')

</main>
@endsection
