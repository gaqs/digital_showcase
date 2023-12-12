@extends('web.sections.profile.layout')
@section('content')
<section id="create_business">
    <div class="container-xl relative pb-20">
        <header class="mb-5">
            <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                Mis Productos
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
                        <x-link href="#" class="text-rose-700">Mis Productos</x-link>
                    </li>
                </ol>
            </nav>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>


        <!--
        <div class="col-span-12 mb-5">
            <div class="flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row">
                <p class="p-10">No tiene productos creados en su perfil. Si desea agregar uno, haga <x-link href="{{ route('product.create') }}#create_product">click aquí</x-link></p>
                <p>Recuerde que debe crear un negocio primero para guardar sus productos.</p>
            </div>
        </div>
    -->
        <div class="">
            @livewireScripts
            <livewire:products-table theme="tailwind">
        </div>

    </div>




    </div>
</section>



@endsection
