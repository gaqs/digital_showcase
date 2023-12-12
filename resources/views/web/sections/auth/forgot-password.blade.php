<x-guest-layout>
    <x-link href="javascript:history.back()"><i class="fa-solid fa-arrow-left-long"></i> Volver</x-link>
    <br><br>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        ¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace de restablecimiento de contraseña por correo electrónico que te permitirá elegir una nueva.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-float id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Correo electrónico" />
            <x-input-error :messages="$errors->get('email')"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button type="submit" value="danger">
                <i class="fa-solid fa-paper-plane"></i> {{ __('Email Password Reset Link') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
