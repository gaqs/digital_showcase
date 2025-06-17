<x-app-layout>
    <div class="container-xl pt-28 pb-20 md:pt-40 md:pb-20">
        <div class="grid grid-cols-12">
            <div class="col-span-12 md:col-start-5 md:col-span-4">
                <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="py-4 text-xl font-semibold leading-tight text-neutral-800 dark:text-neutral-50 text-center">
                        Inicia sesión
                    </h5>
                    <p class="mb-4 text-base text-neutral-600 dark:text-neutral-200">

                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div>
                                <x-input-float id="input_email" type="email" name="email"  :value="old('email')" placeholder="Correo electrónico" required  />
                                <x-input-error :messages="$errors->get('email')" class="mt-1"/>
                            </div>
                            <div class="mt-5">
                                <x-input-float id="input_password" type="password" name="password"
                                    required placeholder="Contraseña" />
                                <x-input-error :messages="$errors->get('password')" class="mt-1"/>
                            </div>

                            <div class="flex mt-3">
                                <div class="basis-1/2">
                                    <x-checkbox id="remember_me" name="remember" class="block mt-4">¿Recordar?</x-checkbox>
                                </div>
                                <div class="basis-1/2 text-right">
                                    @if (Route::has('password.request'))
                                        <x-link href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</x-link>
                                    @endif
                                </div>
                            </div>

                            <x-button type="submit" class="mt-5 w-full !font-bold capitalize !py-3 !text-base" value="danger">
                                <i class="fa-solid fa-door-open"></i> Acceder
                            </x-button>
                        </form>
                        <div class="grid mt-5 text-center">O Inicia sesión con</div>
                        <div class="flex mt-5 gap-3">
                            <div class="basis-1/2">
                                <a href="#">
                                    <x-button class="w-full md:text-center !font-bold !py-3" value="secondary">
                                        <img src="{{ asset('img/google.png') }}" alt="" width="15" class="inline mr-2"><span>Acceder con Google</span>
                                    </x-button>
                                </a>
                            </div>
                            <div class="basis-1/2">
                                <a href="#">
                                    <x-button class="w-full md:text-center !font-bold !py-3" value="secondary">
                                        <img src="{{ asset('img/icons/facebook_icon.png') }}" alt="" width="18" class="inline mr-2"><span>Acceder con Facebook</span>
                                    </x-button>
                                </a>
                            </div>
                        </div>
                        <div class="grid mt-5 text-center">¿No tienes una cuenta? <x-link class="contents" href="{{ route('register') }}">Registrate</x-link></div>

                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
