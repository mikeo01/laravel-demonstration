@extends('index')

@section('content')
    <x-card title="Login">
        <x-form method="POST" :action="route('login')">
            <x-form-control>
                <x-label for="email">Email</x-label>
                <x-input type="email" name="email" :value="old('email', '')" id="email" placeholder="email" required="true" />
                <x-muted>Your email address you used for registering</x-muted>
            </x-form-control>

            <x-form-control>
                <x-label for="password">Password</x-label>
                <x-input type="password" name="password" :value="old('password', '')" id="password" placeholder="password" required="true" />
            </x-form-control>

            <x-form-control>
                <x-button class="btn-primary">Login</x-button>
            </x-form-control>
        </x-form>
    </x-card>
@endsection