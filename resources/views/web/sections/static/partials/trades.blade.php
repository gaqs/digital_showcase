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
        @if( true )
        <section id="trade_splide" class="splide" aria-label="Listado de productos">
            <div class="splide__track">
                <ul class="splide__list">

                @for($i=0; $i < 3; $i++)
                    <li class="splide__slide">
                        <a href="{{ route('trade.show', ['id' => 0]) }}">
                            <div id="trade_container" class="relative flex flex-col justify-between block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 h-full">
                                <div id="trade_category" class="w-fit absolute text-xs text-white top-5 right-4 px-3 py-1 rounded-full" style="background-color: red">
                                    categoria #1
                                </div>
                                <div id="trade_image" class="overflow-hidden h-[300px]">
                                    <img class="rounded-t-lg w-full h-full object-cover" src="https://picsum.photos/500/500" alt="" />
                                </div>
                                <div id="trade_info" class="py-3 text-center">
                                    <div id="trade_name" class="price text-lg text-danger-600 rounded">
                                        Gustavo Quilodran
                                    </div>
                                    <div id="trade_price" class="font-medium dark:text-neutral-200 text-xl">
                                        Desarrollador Web
                                    </div>
                                    <div id="trade_description" class="text-sm text-neutral-500 dark:text-neutral-400 mb-3">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.
                                    </div>
                                    <span class="text-red-500 font-bold">
                                        Saber más &raquo;
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endfor
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
