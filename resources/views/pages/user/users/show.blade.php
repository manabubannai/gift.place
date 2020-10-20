@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-user-show">
        <div class="">
            {{ $user->name }}
            {{ $user->slug }}

            @if (Auth::user()->can('user-user-can-edit', $user))
              <a href="{{ route('user.users.edit', $user->slug) }}">edit</a>
            @endif

          </div>
    </div>
@endsection
