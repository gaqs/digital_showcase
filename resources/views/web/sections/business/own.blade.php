@extends('web.sections.profile.layout')
@section('content')
    <section id="create_business">
        <div class="grid grid-cols-12 relative pb-20">
            <header class="mb-5 col-span-12">
                <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Mis Negocios
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
                            <x-link href="#" class="text-rose-700">Mis Negocios</x-link>
                        </li>
                    </ol>
                </nav>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Aqui se encuentra el listado de negocios que ha creado, además de ver, editar y borrar cada uno de ellos.
                </p>
            </header>

            @if (count($business) == 0)
                <div class="col-span-12 mb-5">
                    <div
                        class="flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row">
                        <p class="p-10">No tiene negocios creados en su perfil. Si desea agregar uno, haga <x-link
                                href="{{ route('business.create') }}#create_business">click aquí</x-link>
                        </p>
                    </div>
                </div>
            @else
                @for ($i = 0; $i < count($business); $i++)
                    @php

                        $avatar = 'uploads/business/'.show_business_avatar($business[$i]->folder);
                    @endphp

                    <div class="col-span-12 md:col-span-10 mb-5">

                        <div class="flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row">

                            <img class="rounded-t-lg object-cover md:h-auto md:w-60 md:rounded-none md:rounded-l-lg"
                                src="{{ asset($avatar) }}" alt="" />

                            <div class="flex flex-col justify-start p-6 pb-0 w-full">
                                <h5 class="text-xl font-medium text-neutral-900 dark:text-neutral-50">
                                    {{ $business[$i]->name }}
                                </h5>
                                <span class="mb-4">
                                    <i class="text-rose-500 fa-solid fa-location-dot"></i> {{ $business[$i]->address }}
                                </span>
                                <div class="dark:border-neutral-600 dark:text-neutral-50 mb-4">
                                    <div class="flex flex-row content-center">
                                        <div class="pr-3">
                                            <div id="score"
                                                class="bg-green-700 w-fit font-bold text-white p-3 rounded-xl">
                                                {{ $business[$i]->score }}
                                            </div>
                                        </div>
                                        <div>
                                            <div id="stars" class="inline">
                                                <?= print_stars($business[$i]->score) ?>
                                                <div id="qty_reviews" class="text-neutral-600 text-sm">{{ $business[$i]->qty_comments }} comentarios</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-base text-sm text-neutral-600 dark:text-neutral-200 mb-2">
                                    {{ substr($business[$i]->description, 0, 100) }}...<x-link
                                        class="text-right text-sm mb-4" href="#">Leer más &raquo;</x-link>
                                    <br>
                                </p>

                                <div
                                    class="border-t-2 border-neutral-100 pt-4 dark:border-neutral-600 dark:text-neutral-50 mb-4">
                                    <div class="flex flex-row justify-end">
                                        <div>
                                            <a href="{{ route('business.show', ['id' => $business[$i]->id]) }}">
                                                <x-button value="success"><i class="fa-solid fa-eye"></i> Ver</x-button>
                                            </a>
                                            <a href="{{ route('business.edit', ['id' => $business[$i]->id]) }}">
                                                <x-button><i class="fa-solid fa-pen-to-square"></i> Editar</x-button>
                                            </a>
                                        </div>
                                        <form id="delete_something" class="ml-1" action="{{ route('business.destroy',['id' => $business[$i]->id ]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <x-button value="danger" type="submit" id="delete_business">
                                                <i class="fa-solid fa-trash-can"></i> Borrar
                                            </x-button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </section>

@endsection
