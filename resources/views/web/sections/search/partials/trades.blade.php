<div class="my-3">
    @include('web.sections.static.partials.search')
</div>
<div class="container-xl">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-4 mt-5">
        @if( $results->isEmpty() )
            <div class="col-span-12 md:col-span-4 flex flex-col items-center justify-center mt-28">
                <img src="{{ asset('img/empty.svg') }}" alt="No results" class="w-80 mb-2">
                <p><i>- "Mira lo que encontré..."</i></p>
                <p><i>- "Espera, ahí no hay nada..."</i></p>
                <p><i>- "Exacto!"</i></p>
            </div>
        @endif
        @foreach ( $results as $r )

            <div id="trade_container" class="relative flex flex-col justify-between block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                <a href="{{ route('trade.show', ['id' => $r->id ]) }}">
                    <div id="trade_image" class="overflow-hidden h-[200px]">
                        @php
                            $avatar = 'uploads/trades/'.get_images_from_folder('trades', $r->id, 'avatar');
                        @endphp
                        <img class="rounded-t-lg w-full h-full object-cover" src="{{ asset($avatar) }}" alt="" />
                    </div>
                    <div id="trade_info" class="py-3 text-center">
                        <div id="trade_name" class="text-lg text-danger-600 rounded">
                            {{ $r->name.' '.$r->lastname }}
                        </div>
                        <div id="trade_trade" class="font-medium dark:text-neutral-200 text-xl">
                            {{ $r->trade_categories->name }}
                        </div>
                        <div id="trade_price" class="price text-lg text-danger-600 rounded">
                            {{ $r->price }}
                        </div>
                    </div>
                    <div id="trade_footer" class="flex items-center justify-center border-t-2 border-neutral-100 py-3 mx-3 dark:border-neutral-600 dark:text-neutral-50">
                        <div id="score" class="w-fit text-sm text-white p-1 px-2 rounded-lg mr-2">
                            {{ $r->score }}
                        </div>
                        <div id="trade_comments" class="text-sm">
                            {{ $r->qty_comments }} comentarios.
                        </div>
                    </div>
                </a>
            

            </div>

        @endforeach
    </div>
</div>
