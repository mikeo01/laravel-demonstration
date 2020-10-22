<form method="{{ $method }}" action="{{ $action }}">
    {{ csrf_field() }}
    {{ $slot }}
</form>