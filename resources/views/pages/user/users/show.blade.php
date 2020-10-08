@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-user-show">
        <div class="">
            {{ $user->name }}
            {{ $user->slug }}

            @auth
              <a href="{{ route('user.users.edit', $user->slug) }}">edit</a>
            @endauth

          </div>
    </div>
@endsection
