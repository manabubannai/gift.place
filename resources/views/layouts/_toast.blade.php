@if(session('toast'))
    <toast
    :status="{{ json_encode(session('toast.status')) }}"
    :message="{{ json_encode(session('toast.message')) }}"
    ></toast>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <toast
        :status="'error'"
        :message="{{ json_encode($error) }}"
        ></toast>
    @endforeach
@endif