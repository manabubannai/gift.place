@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-dashboard">

        @each('components.user.messages.index-card', $messages, 'message' ,'pages.user.messages.empty')

        {{ $messages->links('components.pagination.default') }}
    </div>
@endsection
