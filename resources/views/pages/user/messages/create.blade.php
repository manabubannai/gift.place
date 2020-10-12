@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-user-message-create">
        <div class="auth-register mx-auto w-100 py-4 pb-5">
            <h5 class="title title-up text-center mb-3 font-weight-bold gray">投稿</h5>
            <form method="POST" action="{{ route('user.messages.store') }}">
              @csrf

              <div class="row">
                  <div class="form-label-group col-lg-8 mx-auto black font-weight-bold py-2">

                      <textarea name="description" class="form-control" placeholder="入力してください">{{ old('description') }}</textarea>

                  </div>
              </div>

              <div class="text-center">
                <button class="m-btn mx-auto col-md-4" type="submit">
                  投稿する
                </button>
              </div>
            </form>

          </div>
    </div>
@endsection
