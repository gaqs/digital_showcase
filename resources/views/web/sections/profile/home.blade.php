@extends('web.sections.profile.layout')
@section('content')
    <section id="update_passowrd">
        <div class="container-xl relative pb-20">
        <header>
            <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                Inicio
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

            </p>
        </header>
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-12 md:col-span-4">
                <div class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-id-card text-rose-500"></i> Opciones de perfil
                    </h5>
                    <div class="text-neutral-700">
                        Aqui tienes distintas opciones que puedes realizar desde esta sección
                    </div>
                    <br>
                    <div>
                        <ul>
                            <li><x-link href="{{ route('profile.edit') }}">Editar tu perfil</x-link></li>
                            <li><x-link href="{{ route('password.home') }}">Cambiar contraseña</x-link></li>
                            <li><x-link href="{{ route('business.create')  }}">Crear nuevo negocio</x-link></li>
                            <li><x-link href="{{ route('product.create') }}">Crear nuevo producto</x-link></li>
                        </ul>
                    </div>
                    <br>
                    <div>
                        Cualquier duda, problema, puedes comunicarte directamente al correo <b>gaqs.02@gmail.com</b>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-2">
                <div class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-clock text-rose-500"></i> Acerca de {{ Auth::user()->name }}
                    </h5>
                    <div class="flex flex-col">
                        <div class="font-bold">Dirección</div>
                        <div class="mb-4">{{ $profile->address ?? '' }}</div>
                        <div class="font-bold">Teléfono</div>
                        <div class="mb-4">{{ $profile->phone ?? '' }}</div>
                        <div class="font-bold mb-2">RRSS</div>
                    </div>
                    <div id="rrss" class="grid grid-cols-4 gap-4">
                        <a href="{{ $profile->facebook ?? '' }}" target="_blank" data-te-toggle="tooltip" data-te-placement="top" title="Facebook">
                            <img src="{{ asset('img/icons/facebook_icon.png') }}" alt="" width="50" class="">
                        </a>
                        <a href="{{ $profile->instagram ?? '' }}" target="_blank">
                            <img src="{{ asset('img/icons/instagram_icon.png') }}" alt="" width="50" class="">
                        </a>
                        <a href="{{ $profile->twitter ?? '' }}" target="_blank">
                            <img src="{{ asset('img/icons/twitter_icon.png') }}" alt="" width="50" class="">
                        </a>
                        <a href="{{ $profile->tiktok ?? '' }}" target="_blank">
                            <img src="{{ asset('img/icons/tiktok_icon.png') }}" alt="" width="50" class="">
                        </a>
                    </div>
                </div>
            </div>
        </div>



        </div>
    </section>
@endsection
