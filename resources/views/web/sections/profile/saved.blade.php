@extends('web.sections.profile.layout')
@section('content')
    <section id="saved_data">
        <div class="container-xl relative pb-20">
            <header>
                <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Guardados
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
                            <x-link href="#" class="text-rose-700">Guardados</x-link>
                        </li>
                    </ol>
                </nav>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Aqui se encuentra el listado de negocios y/o productos que ha guardado.
                </p>
            </header>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-4 mt-5">
                @foreach ( $results as $r )

                @php
                    if( $r->saveable_type == 'Business'){

                        $image = get_images_from_folder('businesss',$r->folder,'gallery');
                        $image = 'uploads/business/'.$r->folder.'/'.reset($image);

                        $route = route('business.show', ['id' => $r->save_id ]);

                    }elseif( $r->saveable_type == 'Product'){
                        $image = get_images_from_folder('products',$r->folder,'gallery');
                        $image = 'uploads/products/'.$r->folder.'/'.reset($image);

                        $route = route('product.show', ['id' => $r->save_id ]);
                    }
                @endphp

                    <div id="data_container" class="relative flex flex-col justify-between block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <a href="{{ $route }}" >

                            <div id="data_category" class="w-fit absolute text-xs text-white top-3 left-3 px-2 py-1 rounded-full {{ ($r->saveable_type == 'Business') ? 'bg-blue-500' : 'bg-red-500' }}">
                                {{ ($r->saveable_type == 'Business') ? 'Negocio' : 'Producto' }}
                            </div>
                            <div id="data_image" class="overflow-hidden h-[200px]">
                                <img class="rounded-t-lg w-full h-full object-cover" src="{{ asset($image) }}" alt="" />
                            </div>
                            <div id="data_info" class="pt-3 text-center">
                                <div id="product_name" class="font-medium dark:text-neutral-200 mb-1">
                                    {{ $r->name }}
                                </div>
                            </div>
                        </a>
                        <div id="data_delete" class="text-xs text-danger-600 rounded m-3 text-end">
                            <form action="{{ route('profile.delete_save') }}" method="POST">
                                @csrf
                                <input type="hidden" name="link" value="true">
                                <input type="hidden" name="id" value="{{ $r->save_id }}">
                                <input type="hidden" name="type" value="{{ $r->saveable_type }}">
                                <button type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>

                @endforeach

            </div>
            <div class="pagination mt-5">
                {{ $results->onEachSide(2)->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </section>
@endsection


