@extends('layouts.app', ['noContainer' => true])

@section('content')
    <div class="p-subscription">
        <div class="settlement">
          <h1 class="page_title">ギフト村を退会する</h1>

          <form method="POST" action="{{ route('user.users.destroy', $user->slug) }}" class="settlement-form">
              @method('DELETE')
              @csrf

              <p>
                退会しても{{ $nextPaymentday }}まで使用できます
              </p>

              <div class="text-center">
                <button class="submit-btn" type="submit">
                  退会する
                </button>
              </div>
            </form>

          </div>
    </div>
@endsection
