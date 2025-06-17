<section id="business">
    <div class="container-xl relative md:px-20 pt-20">
        <div class="grid grid-cols-12 text-center justify-items-center" id="business_categories">
            <div class="col-span-12">
                <h4 class="text-rose-500">Locales destacados</h4>
                <h2 class="text-3xl text-neutral-900 font-bold w-full">¿Que hay de nuevo?</h2>
            </div>
            <div class="col-span-12 my-5">
                @foreach ($categories as $cat)
                    <a href="{{ route('search.show', ['categories_id' => $cat->id]) }}">
                        <x-button value="danger" class="rounded-full w-fit mr-2 mb-2">{{ $cat->name }}</x-button>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" id="business_grid">
            @foreach ($business as $bus)
                @php
                    $avatar = 'uploads/business/' . show_business_avatar($bus->folder);
                @endphp
                
                <a href="{{ route('business.show', ['id' => $bus->id]) }}">

                    <div id="business_container" class="border-4 border-neutral flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row cursor-pointer">
                        <img class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ asset($avatar) }}" alt="" />
                        <div class="flex flex-col justify-start p-6 pb-0">
                            <h5 class="text-xl font-medium text-neutral-900 dark:text-neutral-50">
                                {{ $bus->name }}
                            </h5>
                            <div id="business_address">
                                <i class="text-rose-500 fa-solid fa-road"></i> {{ $bus->address }}
                                <i class="text-rose-500 fa-solid fa-hashtag"></i>{{ $bus->number }}
                            </div>
                            <p class="text-base text-sm text-neutral-600 dark:text-neutral-200 mb-2">
                                {{ strip_tags(substr($bus->description, 0, 150)) }}...
                                <span class="text-red-500 font-bold">
                                    Saber más &raquo;
                                </span>
                                <br>
                            </p>

                            <div class="border-t-2 border-neutral-100 pt-4 dark:border-neutral-600 dark:text-neutral-50 mb-4">
                                <div class="flex justify-between items-center">
                                    <div class="flex flex-row">
                                        <div class="pr-3">
                                            <div id="score" class="bg-green-700 w-fit font-bold text-white p-3 rounded-xl">
                                                {{ $bus->score }}
                                            </div>
                                        </div>
                                        <div>
                                            <div id="stars" class="inline">
                                                <?= print_stars($bus->score) ?>
                                                <div id="qty_reviews" class="text-neutral-600 text-sm">
                                                    {{ $bus->qty_comments }} comentarios
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>

</section>
