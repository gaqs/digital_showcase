<div class="my-3">
    @include('web.sections.static.partials.search')
</div>
<div class="md:container container-xl">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
        @foreach ( $results as $r )

            <div id="product_container" class="relative flex flex-col justify-between block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                <a href="{{ route('product.show', ['id' => $r->id ]) }}">
                    <div id="product_category" class="w-fit absolute text-xs text-white top-5 right-4 px-3 py-1 rounded-full" style="background-color: {{ $r->tw_bg }}">
                        {{ $r->c_name }}
                    </div>
                    <div id="product_image" class="overflow-hidden h-[200px]">
                        <img class="rounded-t-lg w-full h-full object-cover" src="{{ asset('uploads/products/'.$r->folder.'/'.show_product_picture($r->folder)) }}" alt="" />
                    </div>
                    <div id="product_info" class="py-3 text-center">
                        <div id="product_name" class="font-medium dark:text-neutral-200 mb-1">
                            {{ $r->name }}
                        </div>

                        <div id="product_price" class="price text-lg text-danger-600 rounded">
                            ${{ $r->price }}
                        </div>
                    </div>
                </a>

                <a href="{{ route('business.show', ['id' => $r->business_id]) }}">
                    <div id="product_business" class="flex items-center justify-center border-t-2 border-neutral-100 py-3 mx-3 dark:border-neutral-600 dark:text-neutral-50">
                        <div id="score" class="w-fit text-sm text-white p-1 px-2 rounded-lg mr-2">
                            {{ $r->b_score }}
                        </div>
                        <div id="product_business_name" class="text-sm">
                            {{ $r->b_name }}
                        </div>
                    </div>
                </a>

            </div>

        @endforeach
    </div>
</div>
