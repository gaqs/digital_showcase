@extends('web.sections.profile.layout')
@section('content')
    <section id="update_passowrd">
        <div class="container-xl relative pb-20">
        <header>
            <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                Cambiar contraseña
            </h2>
            <!--Breadcrumb-->
            <nav class="w-full rounded-md">
                <ol class="list-reset flex">
                    <li>
                        <x-link href="#" class="text-neutral-500">Inicio</x-link>
                    </li>
                    <li>
                        <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
                    </li>
                    <li>
                        <x-link href="#" class="text-rose-700">Mi Perfil</x-link>
                    </li>
                </ol>
            </nav>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>
        <div class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
            <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                <i class="fa-solid fa-unlock-keyhole text-rose-500"></i> Cambiar contraseña
            </h5>
            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('put')
                <div class="flex flex-row gap-4">
                    <div class="basis-3/5">
                        <div>
                            <x-input-large id="current_password" name="current_password" type="password"
                                class="mt-1 block w-full" autocomplete="current-password" placeholder="Contraseña actual" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-large id="password" name="password" type="password" class="mt-5 block w-full"
                                autocomplete="new-password" placeholder="Nueva contraseña" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-large id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-5 block w-full" autocomplete="new-password" placeholder="Confirme contraseña" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                </div>


                <div class="flex items-center gap-4">
                    <x-button class="!px-7 !pb-3 !pt-3 !text-sm !font-bold" value="danger">{{ __('Save') }}</x-button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>

            </form>
        </div>



        </div>
    </section>
@endsection
