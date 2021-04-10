@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-message-create">
      <h1 class="page_title">投稿する</h1>

        <form action="{{ route('user.messages.store') }}" class="settlement-form" method="POST">
          @csrf

          <textarea name="description" rows="10" class="post-textarea" placeholder="つぶやいてみる(140文字まで)">{{ old('description') }}</textarea>

          <input type="submit" value="感謝の気持ちをつぶやく" class="settlement-submit post-btn">
        </form>
    </div>
@endsection
