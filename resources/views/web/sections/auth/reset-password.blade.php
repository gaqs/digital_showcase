<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 mt-4">
            Ingresa tu correo y la nueva contraseña, ademas de la confirmación de la misma para realizar el cambio.
        </div>

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-float id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" placeholder="Correo electrónico" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-float id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Contraseña"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-float id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button type="submit" value="danger">
                <i class="fa-solid fa-unlock-keyhole"></i> {{ __('Reset Password') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
