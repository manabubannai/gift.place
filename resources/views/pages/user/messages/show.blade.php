@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-message-show">

        <div class="">
            @include('components.message.show-card', ['message' => $message])

            <!-- <message-like-button
                :message-id="{{ json_encode($message->id) }}"
                :default-like="{{ json_encode($defaultLike) }}"
                :default-is-liked="{{ json_encode($isLiked) }}">
            </message-like-button>

            @if(!empty($likedUsers))
              @foreach($likedUsers as $likedUser)
                {{ $likedUser->name }}
              @endforeach
            @endif -->

          </div>
    </div>
@endsection
