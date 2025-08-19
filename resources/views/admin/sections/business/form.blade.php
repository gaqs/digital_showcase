<div class="block rounded-lg bg-white shadow-secondary-1 dark:bg-surface-dark dark:text-white text-surface mb-10 container mx-auto">
    <div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">
        <i class="fas fa-edit"></i> Editar Negocio
    </div>
    <div class="grid grid-cols-12 gap-4 p-6">
        <div class="col-span-8">
            <x-input-large :value="old('name', $business->name ?? null)" id="input_name" name="name" type="text" class="mt-3 block w-full" placeholder="Nombre" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="col-span-2">
            <x-input-large :value="old('score', $business->score ?? null)" id="input_score" name="score" type="text" class="mt-3 block w-full" placeholder="Puntaje" maxlength="255" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('score')" />
        </div>
        <div class="col-span-2">
            <x-input-large :value="old('qty_comments', $business->qty_comments ?? null)" id="input_qty_comments" name="qty_comments" type="text" class="mt-3 block w-full" placeholder="Qty Comentarios" maxlength="255" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('qty_comments')" />
        </div>
        <div class="col-span-4 mt-3">
            <select data-te-select-init data-te-select-size="lg" data-te-select-init data-te-select-filter="true"  id="select_categories_id" name="categories_id" required>
                {{ category_list( old('categories_id', $business->categories_id ?? null) ) }}
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('email_verified_at')" />
        </div>
        <div class="col-span-8">
            <x-input-large :value="old('keywords', $business->keywords ?? null)" id="input_keywords" name="keywords" type="text" class="mt-3 block w-full" placeholder="Palabras clave" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('keywords')" />
        </div>

        <div class="col-span-6">
            <x-input-large :value="old('email', $business->email ?? null)" id="input_email" name="email" type="text" class="mt-3 block w-full" placeholder="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <div class="col-span-6">
            <x-input-large :value="old('email_2', $business->email_2 ?? null)" id="input_email_2" name="email_2" type="text" class="mt-3 block w-full" placeholder="Correo secundario" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('email_2')" />
        </div>
        <div class="col-span-12 mt-3">
            <div id="admin_wysiwyg">{!! old('description', $business->description ?? null) !!}</div>
            <textarea maxlength="2000" id="description" name="description" placeholder="Descripcion" class="hidden"> </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
        <div class="col-span-6">
            <x-input-large :value="old('phone', $business->phone ?? null)" id="input_phone" name="phone" type="text" class="mt-3 block w-full" placeholder="Teléfono" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div class="col-span-6">
            <x-input-large :value="old('whatsapp', $business->whatsapp ?? null)" id="input_whatsapp" name="whatsapp" type="text" class="mt-3 block w-full" placeholder="Whatsapp" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
        </div>
        <div class="col-span-4">
            <x-input-large :value="old('web', $business->web ?? null)" id="input_web" name="web" type="text" class="mt-3 block w-full" placeholder="Página web" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('web')" />
        </div>

        <div class="col-span-4">
            <x-input-large :value="old('facebook', $business->facebook ?? null)" id="input_facebook" name="facebook" type="text" class="mt-3 block w-full" placeholder="Facebook" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
        </div>
        <div class="col-span-4">
            <x-input-large :value="old('instagram', $business->instagram ?? null)" id="input_instagram" name="instagram" type="text" class="mt-3 block w-full" placeholder="Instagram" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
        </div>
        <div class="col-span-4">
            <x-input-large :value="old('x', $business->x ?? null)" id="input_twitter" name="x" type="text" class="mt-3 block w-full" placeholder="X" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('x')" />
        </div>
        <div class="col-span-4">
            <x-input-large :value="old('tiktok', $business->tiktok ?? null)" id="input_tiktok" name="tiktok" type="text" class="mt-3 block w-full" placeholder="TikTok" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
        </div>
        <div class="col-span-4">
            <x-input-large :value="old('mercadolibre', $business->mercadolibre ?? null)" id="input_mercadolibre" name="facebook" type="text" class="mt-3 block w-full" placeholder="Mercado Libre" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('mercadolibre')" />
        </div>
        <div class="col-span-4">
            <x-input-large :value="old('yapo', $business->yapo ?? null)" id="input_Yapo" name="yapo" type="text" class="mt-3 block w-full" placeholder="Yapo" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('yapo')" />
        </div>
        <div class="col-span-4">
            <x-input-large :value="old('aliexpress', $business->aliexpress ?? null)" id="input_aliexpress" name="aliexpress" type="text" class="mt-3 block w-full" placeholder="Aliexpress" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('aliexpress')" />
        </div>

        <!-- direccion y maps -->
        <div class="col-span-8 relative">
            <x-input-large id="input_address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $business->address ?? null)" placeholder="Calle"/>
            <span id="address_loading" class="absolute right-[10px] top-[60%] -translate-y-1/2 hidden">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
            <div id="suggestions_container" class="absolute bg-white w-full z-[9999]"></div>
        </div>
        <div class="col-span-4">
            <x-input-large id="input_number" name="number" type="text" class="mt-1 block w-full" :value="old('number', $business->number ?? null)" placeholder="Número"/>
        </div>
        <div class="col-span-12 relative">
            <div id="map" class="h-96 mt-3"></div>
            <div id="coordinates">
                <input id="input_latitude" name="latitude" type="text" class="" value=" <?= old('latitude', $business->latitude ?? '-41.46518') ?>" placeholder="Latitud" required readonly />
                <input id="input_longitude" name="longitude" type="text" class="" value="<?= old('longitude', $business->longitude ?? '-72.93816') ?>" placeholder="Longitud" required readonly />
            </div>
        </div>

        <!-- avatar -->
        <div class="col-span-12 md:col-span-3 mt-5 relative">

            <input type="hidden" value="{{ $business->folder }}" name="folder" id="folder">

            <p>Foto de Perfil de Negocio</p>

            <div class="mb-3 mt-3 w-full">
                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3 file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white file:dark:text-white" type="file" name="avatar"/>
            </div>

            <img src="<?= asset('uploads/business/'.show_business_avatar($business->folder)) ?>" alt="" class="mt-3" />

            <x-button id="delete_file" type="button" value="danger" class="mt-2 hidden" data-folder="{{ show_business_avatar($business->folder) }}"><i class="fas fa-trash-alt"></i></x-button>

            <p class="mt-3"><i>*Seleccionar una nueva imagen reemplazará la foto de perfil actual.</i></p>

        </div>

        <!-- galeria -->
        <div class="col-span-12 md:col-span-9 mt-5 relative text">
            <p>Fotos del Negocio</p>
            @php
                $images = get_images_from_folder('business',$business->folder,'gallery');
            @endphp

            <div class="mb-3 mt-3 w-[50%]">
                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3 file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white" type="file" name="gallery[]" multiple/>
            </div>
   
            <div class="grid grid-cols-3 gap-4 mt-3">
                @foreach ($images as $i)
                <div class="col-span-1">
                    <img src="<?= asset("uploads/business/".$business->folder."/".$i) ?>" alt="">

                    <x-button id="delete_file" type="button" value="danger" class="mt-2" data-type="business" data-file="{{ $business->folder.'/'.$i }}"><i class="fas fa-trash-alt"></i></x-button>
            
                </div>
                @endforeach
            </div>

            <p class="mt-3"><i>*Seleccionar imagenes agregará mas al perfil.</i></p>
            
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4 p-6">
        <x-button type="submit" class="w-fit">Guardar</x-button>
    </div>

</div>



