@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-message-show">
        <div class="">
            {{ $message->description }}

          </div>
    </div>
@endsection
