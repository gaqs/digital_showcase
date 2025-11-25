<section id="products" class="md:px-20">
    <div class="container-xl relative pt-32">
        <div class="grid grid-cols-12 text-center" id="products_categories">
            <div class="col-span-12 mb-5">
                <h4 class="text-rose-500">Productos destacados</h4>
                <h2 class="text-3xl text-neutral-900 font-bold w-full">Nuevos para ti</h2>
            </div>
        </div>
        @if( count($products) > 0 )
        <section id="product_splide" class="splide" aria-label="Listado de productos">
            <div class="splide__track">
                  <ul class="splide__list">

                    @foreach($products as $pro)
                      <li class="splide__slide" data-splide-interval="3000">
                        <div id="product_container" class="hvr-shrink relative flex flex-col justify-between block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 h-full">
                            <a href="{{ route('product.show', ['id' => $pro->id ]) }}">
                                <div id="product_category" class="w-fit absolute text-xs text-white top-5 right-4 px-3 py-1 rounded-full" style="background-color: {{ $pro->tw_bg }}">
                                    {{ $pro->c_name }}
                                </div>
                                <div id="product_image" class="overflow-hidden h-[200px]">
                                    @php
                                        $image = get_images_from_folder('products', $pro->id, 'gallery');
                                    @endphp
                                    <img class="rounded-t-lg w-full h-full object-cover" src="{{ asset('uploads/products/'.reset($image)) }}" alt="" />
                                </div>
                                <div id="product_info" class="py-3 text-center">
                                    <div id="product_name" class="font-medium dark:text-neutral-200 mb-1">
                                        {{ $pro->name }}
                                    </div>

                                    <div id="product_price" class="price text-lg text-danger-600 rounded">
                                        {{ $pro->price }}

                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('business.show', ['id' => $pro->b_id]) }}">
                                <div id="product_business" class="flex items-center justify-center border-t-2 border-neutral-100 py-3 mx-3 dark:border-neutral-600 dark:text-neutral-50">
                                    <div id="score" class="w-fit text-sm text-white p-1 px-2 rounded-lg mr-2">
                                        {{ $pro->b_score }}
                                    </div>
                                    <div id="product_business_name" class="text-sm">
                                        {{ $pro->b_name }}
                                    </div>
                                </div>
                            </a>

                        </div>
                      </li>
                      @endforeach
                  </ul>
            </div>
        </section>
        @else
        <section id="product_splide" aria-label="No hay productos" class="text-center">
            <img src="{{ asset('img/camping.svg') }}" alt="" class="w-[400px] mx-auto mb-5">
            <p><i>- "Limpio y vacío, perfecto para un camping".</i></p>
        </section>
        @endif
    </div>
</section>
<script type="module">
    var splide = new Splide( '#product_splide', {
        type   : 'loop',
        autoplay: 'playing',
        perPage: 4,
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
