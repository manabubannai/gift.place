@if(session('modal'))
    <show-modal
    :status="{{ json_encode(session('toast.status')) }}"
    :message="{{ json_encode(session('toast.message')) }}"
    ></show-modal>
@endif