@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-message-show">
        <div class="">
            {{ $message->description }}

            @auth
              <message-like-button
                  :message-id="{{ json_encode($message->id) }}"
                  :default-like="{{ json_encode($defaultLike) }}"
                  :default-is-liked="{{ json_encode($isLiked) }}">
              </message-like-button>
            @endauth

          </div>
    </div>
@endsection
