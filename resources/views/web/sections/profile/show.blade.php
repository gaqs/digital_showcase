<x-app-layout>
    @php
        $avatar = isset($profile->avatar) ? 'uploads/users/' . $user->id . '/' . $profile->avatar : 'uploads/users/default/_avatar.jpg';
        $banner = isset($profile->banner) ? 'uploads/users/' . $user->id . '/' . $profile->banner : 'uploads/users/default/_banner.jpg';
    @endphp
    <div class="relative overflow-hidden bg-cover bg-no-repeat p-20 mt-20 text-center"
        style="background-image: url('{{ asset($banner) }}'); height: 300px"></div>
    <div class="container-xl relative md:px-20 -mt-36">
        <div class="grid grid-cols-12 gap-5">

            <div id="user_info"
                class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 col-span-4">

                <div class="h-full w-full overflow-hidden bg-fixed relative z-10">
                    <div class="flex flex-col h-full items-center mt-2">
                        <div id="avatar" class="border-8 border-danger rounded-full overflow-hidden">
                            <img src="{{ asset($avatar) }}" class="w-32 rounded-full shadow-lg" alt="Avatar" />
                        </div>
                        <div class="flex flex-col mt-2 text-center">
                            <div class="text-neutral-700 text-2xl font-bold">
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="mt-5">
                            <ul>
                                <li
                                    class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                    <div class="flex flex-rows items-center">
                                        <div class="mr-3">
                                            <i class="fa-solid fa-globe text-4xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-info-700">Sitio Web</div>
                                            <div class="text-sm">{{ $profile->web }}</div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                    <div class="flex flex-rows items-center">
                                        <div class="mr-3">
                                            <i class="fa-solid fa-envelope-open-text text-4xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-info-700">Correo electrónico</div>
                                            <div class="text-sm">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                    <div class="flex flex-rows items-center">
                                        <div class="mr-3">
                                            <i class="fa-solid fa-phone-volume text-4xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-info-700">Teléfono</div>
                                            <div class="text-sm">{{ $profile->phone }}</div>
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
                                            <div class="text-sm">{{ $profile->address }}</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div id="user_business"
                class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 col-span-8">
                <h5 class="mb-5 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                    Negocios creados
                </h5>
                <div class="grid grid-cols-1 justify-items-center gap-4">

                    @if (count($business) == 0)
                        <div class="col-span-12 flex flex-col items-center justify-center mt-28">
                            <img src="{{ asset('img/no-business.svg') }}" alt="No results" class="w-96 mb-2">
                            <p><i>- "Aquí pondría mis negocios... ¡SI TUVIERA ALGUNO!"</i></p>
                        </div>
                    @else
                        @foreach ($business as $bus)
                            @php
                                $avatar = 'uploads/business/' . show_business_avatar($bus->folder);
                            @endphp
                            <div id="business_container" class="flex flex-col rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 md:flex-row cursor-pointer w-full">
                                <img class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:rounded-none  md:rounded-l-lg" src="{{ asset($avatar) }}" alt="" />
                                <div class="flex flex-col justify-start p-6 pb-0 w-full">
                                    <h5 class="text-xl font-medium text-neutral-900 dark:text-neutral-50">
                                        {{ $bus->name }}
                                    </h5>
                                    <span class="mb-4"><i class="text-rose-500 fa-solid fa-location-dot"></i>
                                        {{ $bus->address }}
                                    </span>
                                    <p class="text-base text-sm text-neutral-600 dark:text-neutral-200 mb-2">
                                        {{ strip_tags(substr($bus->description, 0, 200)) }}...<x-link  href="{{ route('business.show', ['id' => $bus->id]) }}"> Saber más &raquo; </x-link>
                                        <br>
                                    </p>

                                    <div class="border-t-2 border-neutral-100 pt-4 dark:border-neutral-600 dark:text-neutral-50 mb-4">

                                        <div class="flex justify-between items-center">

                                            <div class="flex flex-row">
                                                <div class="pr-3">
                                                    <div id="score"
                                                        class="bg-green-700 w-fit font-bold text-white p-3 rounded-xl">
                                                        {{ $bus->score }}
                                                    </div>
                                                </div>
                                                <div>
                                                    <div id="stars" class="inline">
                                                        <?= print_stars($bus->score) ?>
                                                        <div id="qty_reviews" class="text-neutral-600 text-sm">16
                                                            comentarios</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <a href="{{ route('business.show', ['id' => $bus->id]) }}">
                                                    <x-button value="danger">Saber más &raquo;</x-button>
                                                </a>
                                            </div>


                                        </div>

                                    </div>

                                </div>
                            </div>
                        @endforeach

                    @endif
                </div>

            </div>

            <div id="user_products" class="col-span-12">

            </div>

        </div>
    </div>
</x-app-layout>
