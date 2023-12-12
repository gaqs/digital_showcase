<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-large id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-large id="password" class="block mt-1 w-full" type="password" name="password" required placeholder="Contraseña"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <x-checkbox id="remember_me" name="remember" class="block mt-4">¿Recordar?</x-checkbox>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <x-link href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</x-link>
            @endif

            <x-button type="submit" class="ml-3">
                {{ __('Log in') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
