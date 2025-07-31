<section id="comments">
    <div class="container-xl relative md:px-20 pt-32">
        <div class="grid grid-cols-12 text-center gap-8" id="business_categories">
            <div class="col-span-12">
                <h4 class="text-rose-500">Comentarios recientes</h4>
                <h2 class="text-3xl text-neutral-900 font-bold w-full">Última actividad</h2>
            </div>
            @php
                $b_count = count($business_comments);
                $p_count = count($products_comments);
            @endphp
            @foreach($business_comments as $bc)
            @php
                $avatar = ($bc->u_avatar == null) ? 'uploads/users/default/_avatar.jpg' : 'uploads/users/'.$bc->u_id.'/'.$bc->u_avatar;
            @endphp

            <div class="col-span-12 md:col-span-4">
                <div class="block text-left rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">

                    <div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-neutral-600 dark:text-neutral-50">
                        <div class="flex flex-row content-center">
                            <div class="mr-3" id="user_avatar">
                                <img src="{{ asset($avatar) }}" class="w-12 rounded-full" alt="Avatar" />
                            </div>
                            <div>
                                <p class="font-bold" id="user_name">{{ $bc->u_name }}</p>
                                <p class="text-sm" id="what_comment">Comentó un negocio</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4">
                        <x-link href="#" class="font-bold">{{ $bc->b_name }}</x-link>
                        <div>
                            <div id="stars" class="inline">
                                <?= print_stars($bc->b_score) ?>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-200">
                            <span id="date_comment" class="font-bold">{{ beautiful_date($bc->created_at) }}.</span>
                            {{ substr($bc->body,0, 300).'...' }}
                        </p>
                        <x-link href="{{ route('business.show', ['id' => $bc->business_id]).'#comment_id_'.$bc->comment_id }}" class="font-bold text-sm">Continuar leyendo > </x-link>
                    </div>
                    <div
                        class="border-t-2 text-right text-neutral-400 border-neutral-100 px-3 py-3 dark:border-neutral-600 dark:text-neutral-50">
                        <div class="flex flex-row gap-5 justify-end">
                            <div id="like_count">
                                <i class="fa-regular hover:fa-solid fa-thumbs-up text-2xl text-green-600"></i>
                                {{ comment_likes($bc->comment_id) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

            @if($b_count < 3)
                @for($i = 0; $i < 3 - $b_count; $i++)
                    <div class="col-span-12 md:col-span-4 flex flex-col items-center justify-center">
                        <img src="{{ asset('img/post.svg') }}" alt="Sin comentario" class="w-80">
                        <p class="mt-3"><i>- "Falta un comentario aquí..."</i></p>
                    </div>
                @endfor
            @endif


            @foreach($products_comments as $pc)

            @php
                $avatar = ($pc->u_avatar == null) ? 'uploads/users/default/_avatar.jpg' : 'uploads/users/'.$pc->u_id.'/'.$pc->u_avatar;
            @endphp

            <div class="col-span-12 md:col-span-4">
                <div class="block text-left rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">

                    <div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-neutral-600 dark:text-neutral-50">
                        <div class="flex flex-row content-center">
                            <div class="mr-3" id="user_avatar">
                                <img src="{{ asset($avatar) }}" class="w-12 rounded-full" alt="Avatar" />
                            </div>
                            <div>
                                <p class="font-bold" id="user_name">{{ $pc->u_name }}</p>
                                <p class="text-sm" id="what_comment">Comentó un producto</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4">
                        <x-link href="#" class="font-bold">{{ $pc->p_name }}</x-link>
                        <div>
                            <div id="stars" class="inline">
                                <?= print_stars($pc->p_score) ?>
                            </div>
                        </div>
                        <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-200">
                            <span id="date_comment" class="font-bold">{{ beautiful_date($pc->created_at) }}.</span>
                            {{ substr($pc->body,0, 300).'...' }}
                        </p>
                        <x-link href="{{ route('product.show', ['id' => $pc->product_id]).'#comment_id_'.$pc->comment_id }}" class="font-bold text-sm">Continuar leyendo > </x-link>
                    </div>
                    <div
                        class="border-t-2 text-right text-neutral-400 border-neutral-100 px-3 py-3 dark:border-neutral-600 dark:text-neutral-50">
                        <div class="flex flex-row gap-5 justify-end">
                            <div id="like_count">
                                <i class="fa-regular hover:fa-solid fa-thumbs-up text-2xl text-green-600"></i>
                                {{ comment_likes($pc->comment_id) }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

            @if($p_count < 3)
                @for($i = 0; $i < 3 - $p_count; $i++)
                    <div class="col-span-12 md:col-span-4 flex flex-col items-center justify-center">
                        <img src="{{ asset('img/post.svg') }}" alt="Sin comentario" class="w-80 scale-x-[-1]">
                        <p class="mt-3"><i>- "Falta algo aquí..."</i></p>
                    </div>
                @endfor
            @endif

        </div>
    </div>
</section>
