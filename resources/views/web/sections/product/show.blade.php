<x-app-layout>
    <div class="container-xl relative md:px-20 py-20">
        <div class="grid grid-cols-12 pt-10 gap-5">
            <div id="product_slider" class="col-span-12 md:col-span-7 h-100">
                <div id="main_carousel" class="splide">
                    <div class="splide__arrows splide__arrows--ltr">
                        <button class="splide__arrow splide__arrow--prev !bg-transparent !text-white text-xl">
                            <i class="fa-solid fa-chevron-left text-black"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next !bg-transparent !text-white text-xl">
                            <i class="fa-solid fa-chevron-right text-black"></i>
                        </button>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">
                            @php
                                $images = get_images_from_folder('products', $product->id, 'gallery' );

                                foreach ($images as $img) {
                                    echo '<li class="splide__slide flex justify-center">
                                            <img src="'.asset('uploads/products/'.$product->id.'/'.$img).'" class="" alt="">
                                         </li>';
                                }
                            @endphp
                        </ul>
                    </div>
                </div>
                <ul id="thumbnails" class="thumbnails">
                    @foreach ( $images as $img )
                    <li class="thumbnail">
                        <img src="{{ asset('uploads/products/'.$product->id.'/'.$img) }}" alt="">
                    </li>
                    @endforeach
                </ul>
            </div>
            <div id="product_description" class="col-span-12 md:col-span-5">
                <div class="block rounded-lg bg-white p-6 h-full shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">

                    <div id="shared_buttons">
                        <div class="flex justify-end mb-5">
                            <div class="inline mr-3">
                                <div class="relative" data-te-dropdown-ref>
                                    <button class="disabled:opacity-50 inline-block rounded bg-primary px-4 pb-2 pt-2.5 !text-xs font-medium leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]" type="button" id="share_dropdown"  data-te-dropdown-toggle-ref aria-expanded="false" data-te-ripple-init data-te-ripple-color="light">
                                      <i class="fa-solid fa-share-nodes"></i> Compartir
                                      <span class="ml-2 w-2">
                                        <i class="fa-solid fa-chevron-down"></i>
                                      </span>
                                    </button>
                                    <ul class="absolute z-[1000] float-left m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block" aria-labelledby="share_dropdown" data-te-dropdown-menu-ref>
                                        <li>
                                            @php
                                                echo
                                                ShareButtons::page( url()->current(), 'PM360', [
                                                        'title' => $business->name,
                                                        'rel' => 'nofollow noopener noreferrer',
                                                        'class' => '!text-4xl'
                                                    ])
                                                    ->facebook()
                                                    ->twitter()
                                                    ->whatsapp()
                                                    ->telegram()
                                                    ->mailto()
                                                    ->render();
                                            @endphp
                                        </li>
                                    </ul>
                                  </div>
                            </div>
                            <div class="inline">
                                <x-button class="!text-xs !px-4" value="{{empty($saves) ? 'secondary': 'primary'}}" id="save" data-id="{{ $product->id }}" data-type="Product">
                                    <i class="{{empty($saves) ? 'fa-regular': 'fa-solid'}} fa-heart"></i> Guardar
                                </x-button>
                            </div>
                        </div>
                    </div>

                    <small id="product_name" class="text-neutral-500">Cantidad disponible: {{ $product->stock }} en stock</small>
                    <h5 id="product_name" class="mb-4 text-3xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        {{ $product->name }}
                    </h5>
                    <div id="product_score" class="flex flex-row items-center">
                        <div>
                            <div id="score" class="bg-green-700 w-fit font-bold text-2xl mr-3 text-white p-3 rounded-xl">
                                {{ $product->score }}
                            </div>
                        </div>
                        <div>
                            <div id="container_stars" class=""></div>
                            <div>
                                <div id="qty_reviews" class="text-neutral-600">{{ $product->qty_comments }} comentarios</div>
                                <div id="product_stars" class="inline">
                                    <?= print_stars($product->score) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div id="product_resumen" class="mt-3">
                        <div class="font-bold">Resumen:</div>
                        {{ strip_tags(substr($business->description, 0, 200)) }}... <x-link class="text-right text-sm mb-4" href="#product_description">Leer más &raquo;</x-link>

                    </div>
                    <div id="price" class="price text-xl text-center text-cyan-600 bg-cyan-50 py-2 px-5 w-fit rounded my-5">
                        <b>${{ $product->price }}</b> c/u
                    </div>
                    <div id="product_buy_link">
                        <b>Donde comprar online:</b>
                        <div class="grid grid-cols-2 gap-4 mt-2 justify-content-center">
                            <div>
                                <a href="{{ $product->facebook }}" target="_blank">
                                    <x-button value="danger" class="w-full" type="button" :disabled="$product->facebook == null ? true : false">
                                        Facebook Marketplace
                                    </x-button>
                                </a>
                            </div>
                            <div>
                                <a href="{{ $product->mercadolibre }}" target="_blank">
                                    <x-button value="danger" class="w-full" type="button" :disabled="$product->mercadolibre == null ? true : false">
                                        Mercado Libre
                                    </x-button>
                                </a>
                            </div>
                            <div>
                                <a href="{{ $product->yapo }}" target="_blank">
                                    <x-button value="danger" class="w-full" type="button" :disabled="$product->yapo == null ? true : false">
                                        Yapo
                                    </x-button>
                                </a>
                            </div>
                            <div>
                                <a href="{{ $product->aliexpress }}" target="_blank">
                                    <x-button value="danger" class="w-full" type="button" :disabled="$product->aliexpress == null ? true : false">
                                        Aliexpress
                                    </x-button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="product_buy_local" class="mt-5">
                        <b>Contactándose directamente:</b>
                        <div class="grid grid-cols-2 gap-4 mt-2 justify-content-center">
                            <div>
                                <a href="https://wa.me/{{ $business->whatsapp }}" target="_blank">
                                    <x-button value="danger" class="w-full" type="button" :disabled="$business->whatsapp == null ? true : false">Whatsapp</x-button>
                                </a>
                            </div>
                            <div>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $business->latitude }},{{ $business->longitude }}" target="_blank">
                                    <x-button value="danger" class="w-full" type="button">Dirección Local</x-button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="product_description" class="col-span-12">
                <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="text-xl mb-5 font-medium">Descripción</h5>
                    <div class="descriptions">{!! $product->description !!}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-5 my-5">
            <div id="product_comments" class="col-span-12 md:col-span-8">
                <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    @include('web.sections.product.comments')
                </div>
            </div>
            <div id="product_responsable" class="col-span-12 md:col-span-4">
                @php
                    $avatar = get_images_from_folder('business', $business->id, 'avatar' );
                @endphp
                <div>
                    <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            Responsable
                        </h5>
                        <div class="text-sm text-neutral-600 dark:text-neutral-200">

                            <div class="h-full w-full overflow-hidden bg-fixed relative z-10">
                                <div class="flex flex-col h-full items-center mt-2">
                                    <div id="avatar" class="border-8 border-danger rounded-full overflow-hidden">
                                        <img src="{{ asset('uploads/business/'.$avatar) }}" class="w-32 rounded-full shadow-lg" alt="Avatar" />
                                    </div>
                                    <div class="flex flex-col mt-2 text-center">
                                        <div class="text-neutral-700 text-2xl font-bold">
                                            {{ $business->name }}
                                        </div>
                                        <div class="text-neutral-700">
                                            {{ $business->address }}
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <a href="{{ route('business.show', ['id' => $business->id] ) }}">
                                            <x-button value="danger">Ver Negocio</x-button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="module">
    var splide = new Splide( '#main_carousel', {
        pagination: false,
    });

    // Collects LI elements:
    var thumbnails = document.getElementsByClassName( 'thumbnail' );
    var current;

    for ( var i = 0; i < thumbnails.length; i++ ) {
        initThumbnail( thumbnails[ i ], i );
    }

    // The function to initialize each thumbnail.
    function initThumbnail( thumbnail, index ) {
        thumbnail.addEventListener( 'click', function () {
            splide.go( index );
        });
    }

    splide.on( 'mounted move', function () {
    var thumbnail = thumbnails[ splide.index ];

    if ( thumbnail ) {
        if ( current ) {
            current.classList.remove( 'is-active' );
        }

        thumbnail.classList.add( 'is-active' );
        current = thumbnail;
    }
    });

    splide.mount();
</script>
