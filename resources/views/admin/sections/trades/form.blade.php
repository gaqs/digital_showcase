<div class="block rounded-lg bg-white shadow-secondary-1 dark:bg-surface-dark dark:text-white text-surface mb-10 container-xl md:container mx-auto">
    <div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">
        <i class="fas fa-edit"></i> Editar Usuario
    </div>
    <div class="grid grid-cols-12 gap-4 p-6">
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('trade', $trade->trade ?? null)" id="input_trade" name="trade" type="text" class="mt-3 block w-full" placeholder="Oficio tradicional" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('trade')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('score', $trade->score ?? null)" id="input_score" name="score" type="text" class="mt-3 block w-full" placeholder="Puntaje" maxlength="255" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('score')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('qty_comments', $trade->qty_comments ?? null)" id="input_qty_comments" name="qty_comments" type="text" class="mt-3 block w-full" placeholder="Qty Comentarios" maxlength="255" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('qty_comments')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('name', $trade->name ?? null)" id="input_name" name="name" type="text" class="mt-3 block w-full" placeholder="Nombre" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('lastname', $trade->lastname ?? null)" id="input_lastname" name="lastname" type="text" class="mt-3 block w-full" placeholder="Apellido" maxlength="255" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>
        <div class="col-span-12 md:col-span-12 mt-3">
            <div id="admin_wysiwyg">{!! old('description', $trade->description ?? null) !!}</div>
            <textarea maxlength="2000" id="description" name="description" placeholder="Descripcion" class="hidden"> </textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('phone', $trade->phone ?? null)" id="input_phone" name="phone" type="text" class="mt-3 block w-full" placeholder="Teléfono" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('whatsapp', $trade->whatsapp ?? null)" id="input_whatsapp" name="whatsapp" type="text" class="mt-3 block w-full" placeholder="Whatsapp" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
        </div>
        
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('facebook', $trade->facebook ?? null)" id="input_facebook" name="facebook" type="url" class="mt-3 block w-full" placeholder="Facebook" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('instagram', $trade->instagram ?? null)" id="input_instagram" name="instagram" type="url" class="mt-3 block w-full" placeholder="Instagram" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('x', $trade->x ?? null)" id="input_twitter" name="x" type="url" class="mt-3 block w-full" placeholder="X" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('x')" />
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('tiktok', $trade->tiktok ?? null)" id="input_tiktok" name="tiktok" type="url" class="mt-3 block w-full" placeholder="TikTok" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
        </div>

        <!-- avatar -->
        <div class="col-span-12 md:col-span-4 mt-5 relative">

            <input type="hidden" value="{{ $trade->id }}" name="folder" id="folder">

            <p>Avatar</p>

            <div class="mb-3 mt-3 w-full">
                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3 file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white file:dark:text-white" type="file" name="avatar"/>
            </div>
            @php
                $avatar = get_images_from_folder('trades',$trade->id,'avatar') ?? null;
                $avatar = ($avatar == 'default/_avatar.jpg') ? null : $avatar; 
            @endphp
            <img src="<?= asset('uploads/trades/'.$avatar) ?>" alt="" class="mt-3 max-w-sm" />

            <x-button id="delete_file" type="button" value="danger" class="mt-2 hidden" data-folder="{{ $trade->id }}"><i class="fas fa-trash-alt"></i></x-button>

            <p class="mt-3"><i>*Seleccionar una nueva imagen reemplazará la foto de perfil actual.</i></p>

        </div>

        <!-- banner -->
        <div class="col-span-12 md:col-span-8 mt-5 relative">

            <input type="hidden" value="{{ $trade->id }}" name="folder" id="folder">

            <p>Banner</p>

            <div class="mb-3 mt-3 w-full">
                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3 file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white file:dark:text-white" type="file" name="banner"/>
            </div>
            @php
                $banner = get_images_from_folder('trades',$trade->id,'banner') ?? null;
                $banner = ($banner == 'default/_banner.jpg') ? null : $banner; 
            @endphp
            <img src="<?= asset('uploads/trades/'.$banner) ?>" alt="" class="mt-3" />

            <x-button id="delete_file" type="button" value="danger" class="mt-2 hidden" data-folder="{{ $trade->id }}"><i class="fas fa-trash-alt"></i></x-button>

            <p class="mt-3"><i>*Seleccionar una nueva imagen reemplazará la foto de banner actual.</i></p>

        </div>

        <div class="col-span-12 md:col-span-9 mt-5 relative text">
            <p>Fotos del Oficio</p>
            @php
                $images = get_images_from_folder('trades',$trade->id,'gallery');
            @endphp

            <div class="mb-3 mt-3 w-[50%]">
                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3 file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white" type="file" name="gallery[]" multiple/>
            </div>

            <div class="grid grid-cols-3 gap-4 mt-3">
                @foreach ($images as $i)
                <div class="col-span-1">
                    <img src="<?= asset("uploads/trades/".$i) ?>" alt="">
                    
                    <x-button id="delete_file" type="button" value="danger" class="mt-2" data-type="trade" data-file="{{ $i }}">
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
