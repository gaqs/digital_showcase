<section id="trades" class="mt-32 pt-20 pb-32 relative justify-items-center">

    <div class="absolute inset-0 z-0 overflow-hidden rounded-none">
        <img src="{{ asset('img/trades.png') }}" class="w-full h-full object-cover brightness-50" alt="">
    </div>
    
    <div class="container relative">
        <div class="grid grid-cols-12 text-center" id="products_categories">
            <div class="col-span-12 mb-5">
                <h4 class="text-rose-500">Oficios destacados</h4>
                <h2 class="text-3xl text-white font-bold w-full">Muebles a medida? Problemas eléctricos?</h2>
            </div>
        </div>
        @if( !empty($trades) )
        <section id="trade_splide" class="splide" aria-label="Listado de productos">
            <div class="splide__track">
                <ul class="splide__list">

                @foreach ( $trades as $tra)
                    
                    <li class="splide__slide">
                        <a href="{{ route('trade.show', ['id' => $tra->id]) }}">
                            <div id="trade_container" class="hvr-shrink relative flex flex-col block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 h-full">
                                <div id="trade_image" class="overflow-hidden h-[300px]">
                                    @php
                                        $avatar = 'uploads/trades/'. get_images_from_folder('trades',$tra->id,'avatar');
                                    @endphp
                                    <img class="rounded-t-lg w-full h-full object-cover object-top" src="{{ asset($avatar) }}" alt="" />
                                </div>
                                <div id="trade_info" class="p-6 text-center flex flex-col">
                                    <div id="trade_name" class="text-lg text-danger-600 rounded">
                                        {{ $tra->name.' '.$tra->lastname }}
                                    </div>
                                    <div id="trade_price" class="font-medium dark:text-neutral-200 text-xl mb-3">
                                        {{ $tra->trade }}
                                    </div>
                                    <div id="trade_description" class="text-sm text-neutral-500 dark:text-neutral-400 mb-3">
                                        {!! substr(strip_tags($tra->description),0,150) !!}
                                    </div>
                                    <span class="text-red-500 font-bold mb-3">
                                        Saber más &raquo;
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <x-button value="danger" class="mt-5 float-right">Ver todos</x-button>

        @else
        <section id="product_splide" aria-label="No hay productos" class="text-center">
            <img src="{{ asset('img/camping.svg') }}" alt="" class="w-[400px] mx-auto mb-5">
            <p><i>- "Limpio y vacío, perfecto para un camping".</i></p>
        </section>
        @endif
    </div>
</section>
<script type="module">
    var splide = new Splide( '#trade_splide', {
        type   : 'loop',
        perPage: 3,
        focus  : 'center',
        gap    : 20,
        breakpoints: {
            640: {
                perPage: 1,
            },
            768: {
                perPage: 2,
            },
    }
    });

splide.mount();

</script>
