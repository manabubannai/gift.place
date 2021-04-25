@if(session('modal'))
    <show-modal
    :status="{{ json_encode(session('modal.status')) }}"
    :title="{{ json_encode(session('modal.title')) }}"
    :message="{{ json_encode(session('modal.message')) }}"
    ></show-modal>
@endif