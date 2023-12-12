<x-app-layout>

    <div class="splide mt-20">
        <div class="splide__arrows splide__arrows--ltr">
            <button class="splide__arrow splide__arrow--prev !bg-white !text-white text-xl">
                <i class="fa-solid fa-chevron-left text-black"></i>
            </button>
            <button class="splide__arrow splide__arrow--next !bg-transparent !text-white text-xl">
                <i class="fa-solid fa-chevron-right text-black"></i>
            </button>
        </div>
        <div class="splide__track">
            <ul class="splide__list">
                @php
                    $folder = ($business->folder == null)? 'default' : $business->folder;
                    $base_url = asset('uploads/business/' . $folder) . '/';

                    $i = 0;
                    $j = 0;
                    foreach ($gallery as $img) {
                        echo '<li class="splide__slide overflow-hidden h-[400px] linear_gradient">
                                <img src="' . $base_url . $img . '" class="w-full h-full object-cover" alt="">
                             </li>';
                        if (++$i == 6) {
                            break;
                        }
                    }
                @endphp
            </ul>
        </div>
        <div class="absolute right-20 bottom-12">
            <x-button class="hidden md:block" data-te-toggle="modal" data-te-target="#gallery_modal" value="danger">Ver Galeria</x-button>

            <x-modal id="gallery_modal">
                <div class="flex justify-center">
                    <section id="gallery" class="w-3/4 splide" aria-label="Galería">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($gallery as $img)
                                <li class="splide__slide">
                                    <img src="{{ $base_url.$img }}" alt="">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                </div>

                <ul id="thumbnails_gallery" class="thumbnails">
                    @foreach ($gallery as $img)
                        <li class="thumbnail">
                            <img src="{{ $base_url.$img }}" class="w-full h-full object-cover" alt="">
                        </li>
                    @endforeach
                </ul>
            </x-modal>
        </div>
    </div>

    <div id="busines_name" class="relative md:absolute px-0 md:px-20 mt-10 md:-mt-40 block rounded-lg md:bg-transparent bg-white p-6 mb-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] md:shadow-none dark:bg-neutral-700">
        <div class="flex flex-row items-center">
            <div>
                <div id="business_icon" class="mr-5">
                    <img src="{{ asset('uploads/business/'.$avatar) }}" class="w-32 rounded-full shadow-lg" alt="Avatar" />
                </div>
            </div>
            <div class="text-neutral-600 md:text-white">
                <div id="business_name" class="text-3xl md:text-5xl font-bold">{{ $business->name }}</div>
                <div id="business_stars" class="inline">
                    <?= print_stars($avg_score) ?>
                </div>
                <div id="qty_reviews" class="text-sm inline">{{ $qty_comments }} comentarios</div>

                <div id="business_address">
                    <i class="text-rose-500 fa-solid fa-location-dot"></i> {{ $business->address }}
                </div>
            </div>
        </div>
    </div>

    <div class="container-xl relative md:px-20 py-0 md:py-10">
        <div class="grid grid-cols-12 gap-5">
            <div class="col-span-12 md:col-span-8">
                <div>
                    <div class="block rounded-lg bg-white p-6 mb-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            Descripción
                        </h5>
                        <p class="mb-4 text-neutral-600 dark:text-neutral-200">
                            {{ $business->description }}
                        </p>
                    </div>
                </div>
                <div>
                    <div class="block rounded-lg bg-white p-6 pb-3 mb-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            Productos
                        </h5>
                        <div class="mb-4 text-sm text-neutral-600 dark:text-neutral-200">
                            @if( count($products) != 0 )
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                                    @foreach ($products as $p)
                                        <a href="{{ route('product.show', ['id' => $p->id]) }}" target="_blank">
                                            <div class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                                                <div class="overflow-hidden h-[100px]">
                                                    <img class="rounded-t-lg w-full h-full object-cover" src="{{ asset('uploads/products/'.$p->folder.'/'.show_product_picture($p->folder)) }}" alt="" />
                                                </div>

                                                <div class="p-2 text-center">
                                                    <h5 class="mb-1 text-lg font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                                        {{ $p->name }}
                                                    </h5>
                                                    <p
                                                        class="mb-1 text-base font-bold text-neutral-600 dark:text-neutral-200 text-rose-600">
                                                        ${{ $p->price }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>

                                        @if( ++$j == 8 )
                                            @break
                                        @endif

                                    @endforeach

                            </div>
                            @else
                                <p class="mt-5">No hay productos ingresados.</p>
                            @endif

                            @if( count($products) != 0 )
                                <div class="flex justify-end">
                                    <form action="{{ route('search.show') }}">
                                        <input type="hidden" name="business_id" value="{{ $business->id }}">
                                        <input type="hidden" name="option" value="1">
                                        <x-button type="submit" class="mt-5" value="danger">Ver todos &raquo;</x-button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div>
                    <div class="block rounded-lg bg-white p-6 mb-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            Ubicación
                        </h5>
                        <p class="mb-4 text-sm text-neutral-600 dark:text-neutral-200">
                        <div class="grid grid-cols-12">
                            <div class="col-span-12">
                                <input id="input_latitude" class="hidden" value="{{ $business->latitude }}">
                                <input id="input_longitude" class="hidden" value="{{ $business->longitude }}">

                                <div id="map" class="h-80"></div>

                                <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&libraries=places&v=weekly" defer></script>
                            </div>
                            <div class="col-span-12 mt-2 justify-self-end">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $business->latitude }},{{ $business->longitude }}" target="_blank" class="text-danger">
                                    Ver ubicación en Google Maps &raquo;
                                </a>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
                <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    @include('web.sections.business.comments')
                </div>

            </div>
            <div class="col-span-12 md:col-span-4">
                <div>
                    <div class="block rounded-lg bg-white p-6 mb-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">

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
                                    <x-button class="!text-xs !px-4" value="{{empty($saves) ? 'secondary': 'primary'}}" id="save" data-id="{{ $business->id }}" data-type="Business">
                                        <i class="{{empty($saves) ? 'fa-regular': 'fa-solid'}} fa-heart"></i> Guardar
                                    </x-button>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            Datos Basicos
                        </h5>
                        <p class="mb-4 text-sm text-neutral-600 dark:text-neutral-200">
                        <ul>
                            <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                <div class="flex flex-rows items-center">
                                    <div class="mr-3">
                                        <i class="fa-solid fa-globe text-4xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-info-700">Sitio Web</div>
                                        <div class="text-sm">
                                            <a href="{{ $business->web }}" target="_blank">
                                                {{ $business->web }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                <div class="flex flex-rows items-center">
                                    <div class="mr-3">
                                        <i class="fa-solid fa-envelope-open-text text-4xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-info-700">Correo electrónico</div>
                                        <div class="text-sm">
                                            <a href="mailto:{{ $business->email }}" target="_blank">
                                                {{ $business->email }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                <div class="flex flex-rows items-center">
                                    <div class="mr-3">
                                        <i class="fa-solid fa-phone-volume text-4xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-info-700">Teléfono</div>
                                        <div class="text-sm">{{ $business->phone }}</div>
                                    </div>
                                </div>
                            </li>
                            <li class="w-full py-4">
                                <div class="flex flex-rows items-center">
                                    <div class="mr-3">
                                        <i class="fa-solid fa-location-dot text-4xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-info-700">Dirección</div>
                                        <div id="business_address" class="text-sm">{{ $business->address }}</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        </p>
                    </div>
                </div>

                <div>
                    <div class="block rounded-lg bg-white p-6 mb-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            Puntuación
                        </h5>
                        <div id="product_score" class="flex flex-row items-center">
                            <div>
                                <div id="score" class="bg-green-700 w-fit font-bold text-2xl mr-3 text-white p-3 rounded-xl">
                                    {{ $avg_score }}
                                </div>
                            </div>
                            <div>
                                <div id="container_stars" class=""></div>
                                <div>
                                    <div id="qty_reviews" class="text-neutral-600">{{ $qty_comments }} comentarios</div>
                                    <div id="product_stars" class="inline">
                                        <?= print_stars($avg_score) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="block rounded-lg bg-white p-6 mb-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <h5 class="mb-5 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            Redes Sociales
                        </h5>
                        <div id="rrss" class="grid grid-cols-4 gap-4">
                            <a href="{{ $business->facebook }}" target="_blank">
                                <img src="{{ asset('img/icons/facebook_icon.png') }}" alt="" width="50"
                                    class="">
                            </a>
                            <a href="{{ $business->instagran }}" target="_blank">
                                <img src="{{ asset('img/icons/instagram_icon.png') }}" alt="" width="50"
                                    class="">
                            </a>
                            <a href="{{ $business->twitter }}" target="_blank">
                                <img src="{{ asset('img/icons/twitter_icon.png') }}" alt="" width="50"
                                    class="">
                            </a>
                            <a href="{{ $business->tiktok }}" target="_blank">
                                <img src="{{ asset('img/icons/tiktok_icon.png') }}" alt="" width="50"
                                    class="">
                            </a>
                            <a href="{{ $business->mercadolibre }}" target="_blank">
                                <img src="{{ asset('img/icons/mercadolibre_icon.png') }}" alt=""
                                    width="50" class="">
                            </a>
                            <a href="{{ $business->yapo }}" target="_blank">
                                <img src="{{ asset('img/icons/yapo_icon.png') }}" alt="" width="50"
                                    class="">
                            </a>
                            <a href="{{ $business->aliexpress }}" target="_blank">
                                <img src="{{ asset('img/icons/aliexpress_icon.png') }}" alt=""
                                    width="50" class="">
                            </a>
                            <a href="{{ $business->whatapp }}" target="_blank">
                                <img src="{{ asset('img/icons/whatsapp_icon.png') }}" alt="" width="50"
                                    class="">
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                            Responsable
                        </h5>
                        <div class="text-sm text-neutral-600 dark:text-neutral-200">

                            @php
                                $avatar = ($user->avatar) ? 'uploads/users/' . $user->id . '/' . $user->avatar : 'uploads/users/default/_avatar.jpg';
                                $banner = ($user->banner) ? 'uploads/users/' . $user->id . '/' . $user->banner : 'uploads/users/default/_banner.jpg';
                            @endphp

                            <div class="relative bg-cover bg-no-repeat text-center"
                                style="background-image: url('{{ asset($banner) }}'); height: 150px">
                            </div>
                            <div class="h-full w-full overflow-hidden bg-fixed -mt-24 relative z-10">
                                <div class="flex flex-col h-full items-center mt-2">
                                    <div id="avatar" class="border-8 border-danger rounded-full overflow-hidden">
                                        <img src="{{ asset($avatar) }}" class="w-32 rounded-full shadow-lg"
                                            alt="Avatar" />
                                    </div>
                                    <div class="flex flex-col mt-2 text-center">
                                        <div class="text-neutral-700 text-2xl font-bold">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-neutral-700">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <a href="{{ route('profile.show', ['id' => $user->id]) }}" target="_blank">
                                            <x-button value="danger">Ver Perfil</x-button>
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
    new Splide('.splide', {
        type: 'loop',
        perPage: 3,
        focus: 'center'
    }).mount();


    var splide = new Splide( '#gallery', {
        pagination: false,
    });

    var thumbnails = document.getElementsByClassName( 'thumbnail' );
    var current;

    for ( var i = 0; i < thumbnails.length; i++ ) {
        initThumbnail( thumbnails[ i ], i );
    }

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
