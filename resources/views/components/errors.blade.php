@if ($errors->count())
    <div class="d-flex flex-direction-column">
        @foreach($errors->all() as $error)
            <x-alert class="alert-danger w-100">{{ $error }}</x-alert>
        @endforeach
    </div>
@endif