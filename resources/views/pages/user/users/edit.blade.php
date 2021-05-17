@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-user-edit">
        <!-- <div class="">

          <form method="POST" action="{{ route('user.users.update', $user->slug) }}">
              @method('PUT')
              @csrf

              <div class="row">
                  <div class="form-label-group col-lg-8 mx-auto black font-weight-bold py-2">
                      <input type="text" name="name" value="{{ $user->name }}">
                  </div>
              </div>

              <div class="text-center">
                <button class="m-btn mx-auto col-md-4" type="submit">
                  投稿する
                </button>
              </div>
            </form>

          </div> -->
          <p style="margin: 16px 0;">
            <a href="{{ route('user.subscriptions.card.change.form') }}">カード変更する</a>
          </p>

          <p>
            <a href="{{ route('user.users.destroy.form', \Auth::user()->slug) }}">退会する</a>
          </p>
    </div>
@endsection
