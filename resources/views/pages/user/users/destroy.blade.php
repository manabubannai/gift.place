@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-user-destory">
        <div class="">

          <form method="POST" action="{{ route('user.users.destroy', $user->slug) }}">
              @method('DELETE')
              @csrf

              <div class="text-center">
                <button class="m-btn mx-auto col-md-4" type="submit">
                  退会する
                </button>
              </div>
            </form>

          </div>
    </div>
@endsection
