<x-app-layout>
    @php
        $avatar = get_images_from_folder('trades', $trade_skill->id, 'avatar');
        $banner = get_images_from_folder('trades', $trade_skill->id, 'banner');
        $gallery = get_images_from_folder('trades', $trade_skill->id, 'gallery');
    @endphp
    <!-- imgen banner -->
    <div class="relative overflow-hidden bg-cover bg-no-repeat p-20 mt-20 text-center" style="background-image: url('{{ asset('uploads/trades/'.$banner) }}'); height: 300px"></div>

    <section class="relative justify-items-center pb-20">
        <div class="md:container container-xl md:px-20 -mt-36">
            <div class="grid grid-cols-12 gap-5 item-stretch">

                <div id="user_info" class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:col-span-4 col-span-12 mb-2 h-full">
                    <div class="h-full w-full overflow-hidden bg-fixed relative z-10">
                        <div class="flex flex-col h-full items-center mt-2">
                            <div id="avatar" class="w-full">
                                <img src="{{ asset('uploads/trades/'.$avatar) }}" class="w-full px-10" alt="Avatar" />
                            </div>
                            <div class="flex flex-col mt-5 text-center">
                                <div class="text-neutral-700 text-2xl font-bold">
                                    {{ $trade_skill->name.' '.$trade_skill->lastname }}
                                </div>
                                <div>
                                    {{ $trade_skill->trade }}
                                </div>
                            </div>
                            <div class="mt-5">
                                <ul>
                                    <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                        <div class="flex flex-rows items-center">
                                            <div class="mr-3">
                                                <i class="fab fa-whatsapp text-4xl"></i>
                                            </div>
                                            <div>
                                                <div class="text-info-700">Whatsapp</div>
                                                @if ( $trade_skill->whatsapp == null || $trade_skill->whatsapp == '')
                                                    <div class="text-sm">No disponible</div>
                                                @else
                                                    <div class="text-sm">+569 {{ $trade_skill->whatsapp }}</div>
                                                @endif
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
                                                <div class="text-sm">{{ $trade_skill->email }}</div>
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
                                                <div class="text-sm">+569 {{ $trade_skill->phone }}</div>
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
                                                @if ( $trade_skill->address == null || $trade_skill->address == '')
                                                    <div class="text-sm">No disponible</div>
                                                @else
                                                    <div class="text-sm">{{ $trade_skill->address }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="trade_description" class="md:col-span-8 col-span-12 h-full">

                    <div class="grid grid-cols-12 gap-5">

                        <div id="trade_description" class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 col-span-12">
                            <h2 class="text-2xl font-bold mb-4">Descripción</h2>
 
                            <div id="trade_score" class="flex flex-row items-center mb-5">
                                <div>
                                    <div id="score" class="bg-green-700 w-fit font-bold text-2xl mr-3 text-white p-3 rounded-xl">
                                        {{ $trade_skill->score }}
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <div id="qty_reviews" class="text-neutral-600">{{ $trade_skill->qty_comments }} comentarios</div>
                                        <div id="trade_stars" class="inline">
                                            <?= print_stars( $trade_skill->score ) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-neutral-700 dark:text-neutral-300">
                                {!! $trade_skill->description !!}
                            </p>
                        </div>
                        <div id="rrss" class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 col-span-12">
                            <h2 class="text-2xl font-bold mb-4">Redes Sociales</h2>
                            <div id="rrss" class="grid md:grid-cols-4 grid-cols-2 gap-4">
                            <a href="{{ $trade_skill->facebook }}" target="_blank" class="flex items-center gap-2">
                                <img src="{{ asset('img/icons/facebook_icon.png') }}" alt="" width="40" class="mb-5">
                                <span class="mb-[15px] text-bold">Facebook</span>
                            </a>
                            <a href="{{ $trade_skill->instagram }}" target="_blank" class="flex items-center gap-2">
                                <img src="{{ asset('img/icons/instagram_icon.png') }}" alt="" width="40" class="mb-5">
                                <span class="mb-[15px] text-bold">Instagram</span>
                            </a>
                            <a href="{{ $trade_skill->x }}" target="_blank" class="flex items-center gap-2">
                                <img src="{{ asset('img/icons/x_icon.png') }}" alt="" width="40" class="mb-5">
                                <span class="mb-[15px] text-bold">X</span>
                            </a>
                            <a href="{{ $trade_skill->tiktok }}" target="_blank" class="flex items-center gap-2">
                                <img src="{{ asset('img/icons/tiktok_icon.png') }}" alt="" width="40"  class="mb-5">
                                <span class="mb-[15px] text-bold">Tiktok</span>
                            </a>
                        </div>

                        </div>
                        <div id="trade_images" class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 col-span-12">
                            <h2 class="text-2xl font-bold mb-4">Mis Trabajos</h2>
                            <div class="splide" id="trade_slide">
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
                                            $i = 0;
                                            $j = 0;
                                            foreach ($gallery as $img) {
                                                echo '<li class="splide__slide p-2 overflow-hidden h-[300px]">
                                                        <img src="'.asset('uploads/trades/'.$img).'" class="w-full h-full object-cover" alt="">
                                                    </li>';
                                                if (++$i == 6) {
                                                    break;
                                                }
                                            }
                                        @endphp
                                    </ul>
                                </div>
                                <div>
                                    <x-button class="hidden md:block me-2 float-right" data-te-toggle="modal" data-te-target="#gallery_modal" value="danger">Ver Galeria</x-button>

                                    <x-modal id="gallery_modal">
                                        <div class="flex justify-center">
                                            <section id="gallery" class="w-3/4 splide" aria-label="Galería">
                                                <div class="splide__track">
                                                    <ul class="splide__list">
                                                        @foreach ($gallery as $img)
                                                        <li class="splide__slide flex justify-center items-center">
                                                            <img src="{{ asset('uploads/trades/'.$img) }}" alt="">
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </section>
                                        </div>

                                        <ul id="thumbnails_gallery" class="thumbnails">
                                            @foreach ($gallery as $img)
                                                <li class="thumbnail">
                                                    <img src="{{ asset('uploads/trades/'.$img) }}" class="w-full h-full object-cover" alt="">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </x-modal>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                @include('web.sections.trade.comments')
            </div>

        </div>
    </section>
    
</x-app-layout>
<script type="module">
    new Splide('#trade_slide', {
        type: 'loop',
        perPage: 3,
        focus: 'center',
        breakpoints: {
            640: {
                perPage: 1,
            },
            768: {
                perPage: 2,
            },
        }
    }).mount();
</script>

