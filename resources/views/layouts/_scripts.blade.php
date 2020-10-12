<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'apiToken' => \Auth::user()->api_token ?? null
    ]) !!};
</script>

<script src="{{ asset('js/app.js') }}"></script>
<!-- <script src="{{ asset('js/app.js') }}" defer></script> -->