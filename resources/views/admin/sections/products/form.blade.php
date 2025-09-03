<div class="block rounded-lg bg-white shadow-secondary-1 dark:bg-surface-dark dark:text-white text-surface mb-10 container-xl md:container mx-auto">
    <div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">
        <i class="fas fa-edit"></i> Editar Usuario
    </div>
    <div class="grid grid-cols-12 gap-4 p-6">
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('name', $user->name.' '.$user->lastname ?? null)" id="input_username" name="username" type="text" class="mt-3 block w-full" placeholder="Nombre usuario" maxlength="255" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('name', $business->name ?? null)" id="input_businessname" name="businessname" type="text" class="mt-3 block w-full" placeholder="Nombre negocio" maxlength="255" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('businessname')" />
        </div>
        <div class="col-span-12 md:col-span-8">
            <x-input-large :value="old('name', $product->name ?? null)" id="input_name" name="name" type="text" class="mt-3 block w-full" placeholder="Nombre producto" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="col-span-12 md:col-span-4 mt-3">
            <select data-te-select-init data-te-select-size="lg" data-te-select-init data-te-select-filter="true"  id="select_categories_id" name="categories_id" required>
                {{ category_list( old('categories_id', $product->categories_id ?? null) ) }}
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('email_verified_at')" />
        </div>
        <div class="col-span-12 mt-3">
            <div id="admin_wysiwyg">{!! old('description', $product->description ?? null) !!}</div>
            <textarea maxlength="2000" id="description" name="description" placeholder="Descripcion" class="hidden"> </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('price', $product->price ?? null)" id="input_price" name="price" type="text" class="mt-3 block w-full" placeholder="Precio" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('price')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('others', $product->stock ?? null)" id="input_stock" name="stock" type="text" class="mt-3 block w-full" placeholder="Stock" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('score', $product->score ?? null)" id="input_score" name="score" type="text" class="mt-3 block w-full" placeholder="Puntaje" maxlength="255" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('score')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('qty_comments', $product->qty_comments ?? null)" id="input_qty_comments" name="qty_comments" type="text" class="mt-3 block w-full" placeholder="Qty Comentarios" maxlength="255" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('qty_comments')" />
        </div>

        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('mercadolibre', $product->mercadolibre ?? null)" id="input_mercadolibre" name="facebook" type="text" class="mt-3 block w-full" placeholder="Mercado Libre" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('mercadolibre')" />
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('facebook', $product->facebook ?? null)" id="input_facebook" name="facebook" type="text" class="mt-3 block w-full" placeholder="Facebook" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('yapo', $product->yapo ?? null)" id="input_Yapo" name="yapo" type="text" class="mt-3 block w-full" placeholder="Yapo" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('yapo')" />
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('aliexpress', $product->aliexpress ?? null)" id="input_aliexpress" name="aliexpress" type="text" class="mt-3 block w-full" placeholder="Aliexpress" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('aliexpress')" />
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('others', $product->others ?? null)" id="input_others" name="others" type="text" class="mt-3 block w-full" placeholder="Otra RRSS" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('others')" />
        </div>

        <div class="col-span-12 md:col-span-9 mt-5 relative text">
            <input type="hidden" value="{{ $product->id }}" name="folder" id="folder">
            <p>Fotos del Producto</p>
            @php
                $images = get_images_from_folder('products',$product->id,'gallery');
            @endphp

            <div class="mb-3 mt-3 w-full md:w-[50%]">
                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3 file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white" type="file" name="gallery[]" multiple/>
            </div>

            <div class="grid grid-cols-3 gap-4 mt-3">
                @foreach ($images as $i)
                <div class="col-span-1">
                    <img src="<?= asset("uploads/products/".$i) ?>" alt="">
                    <x-button id="delete_file" type="button" value="danger" class="mt-2" data-type="product" data-file="{{ $i}}">
                        <i class="fas fa-trash-alt"></i>
                    </x-button>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    <div class="grid grid-cols-12 gap-4 p-6">
        <x-button type="submit" class="w-fit">Guardar</x-button>
    </div>

</div>
