<div class="block rounded-lg bg-white shadow-secondary-1 dark:bg-slate-800 dark:text-white text-surface mb-10 container-xl md:container mx-auto">
    <div class="border-b-2 border-neutral-100 px-6 py-3 dark:border-white/10">
        <i class="fas fa-edit"></i> Editar Usuario
    </div>
    <div class="grid grid-cols-12 gap-4 p-6">
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('name', $user->name ?? null)" id="input_name" name="name" type="text" class="mt-3 block w-full" placeholder="Nombre" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('lastname', $user->lastname ?? null)" id="input_lastname" name="lastname" type="text" class="mt-3 block w-full" placeholder="Apellido" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('email', $user->email ?? null)" id="input_email" name="email" type="text" class="mt-3 block w-full" placeholder="Correo electrónico" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('email_verified_at', $user->email_verified_at ?? null)" id="input_email_verified_at" name="email_verified_at" type="text" class="mt-3 block w-full" placeholder="Fecha verificación email" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('email_verified_at')" />
        </div>
        <div class="col-span-12 md:col-span-3">
            <x-input-large :value="old('updated_at', $user->updated_at ?? null)" id="input_updated_at" name="updated_at" type="text" class="mt-3 block w-full" placeholder="Última actualización" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('updated_at')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('password')" id="input_password" name="password" type="text" class="mt-3 block w-full" placeholder="Contraseña" maxlength="255" />
            <small class="ms-1 text-neutral-500">Si no desea cambiar la contraseña, dejar este espacio en blanco.</small>
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>
        <div class="col-span-12 md:col-span-4 mb-3 mt-3">
            <select data-te-select-init data-te-select-size="lg" data-te-select-init data-te-select-filter="true" id="role" name="role">
                {{ role_list( old('role', $user->role) ) }}
            </select>
            <label data-te-select-label-ref>Rol</label>
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-input-large :value="old('phone', $profile->phone ?? null)" id="input_phone" name="phone" type="text" class="mt-3 block w-full" placeholder="Teléfono" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>
        <div class="col-span-12 md:col-span-8">
            <x-input-large :value="old('address', $profile->address ?? null)" id="input_address" name="address" type="text" class="mt-3 block w-full" placeholder="Dirección" maxlength="255" required />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>
        <div class="col-span-12">
            <x-textarea id="input_description" name="description" type="text" class="mt-3 block w-full" placeholder="Descripción" maxlength="255"> {{ old('description', $profile->description ?? null) }}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('facebook', $profile->facebook ?? null)" id="input_facebook" name="facebook" type="text" class="mt-3 block w-full" placeholder="Facebook" maxlength="255" />
            <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('instagram', $profile->instagram ?? null)" id="input_instagram" name="instagram" type="text" class="mt-3 block w-full" placeholder="Instagram" maxlength="255" />
            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('twitter', $profile->x ?? null)" id="input_x" name="x" type="text" class="mt-3 block w-full" placeholder="X" maxlength="255" />
            <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-input-large :value="old('tiktok', $profile->tiktok ?? null)" id="input_tiktok" name="tiktok" type="text" class="mt-3 block w-full" placeholder="Tiktok" maxlength="255" />
            <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
        </div>

        <!-- avatar -->
        <div class="col-span-12 md:col-span-4 mt-5 relative">

            <input type="hidden" value="{{ $user->id }}" name="folder" id="folder">

            <p>Perfil</p>

            <div class="mb-3 mt-3 w-full">
                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3 file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white file:dark:text-white" type="file" name="avatar"/>
            </div>
            @php
                $avatar = get_images_from_folder('users',$user->id,'avatar') ?? null;
                $avatar = ($avatar == 'default/_avatar.jpg') ? null : $avatar; 
            @endphp
            <img src="<?= asset('uploads/users/'.$avatar) ?>" alt="" class="mt-3 max-w-sm" />

            <x-button id="delete_file" type="button" value="danger" class="mt-2 hidden" data-folder="{{ $user->id }}"><i class="fas fa-trash-alt"></i></x-button>

            <p class="mt-3"><i>*Seleccionar una nueva imagen reemplazará la foto de perfil actual.</i></p>

        </div>

        <!-- banner -->
        <div class="col-span-12 md:col-span-8 mt-5 relative">

            <input type="hidden" value="{{ $user->id }}" name="folder" id="folder">

            <p>Banner</p>

            <div class="mb-3 mt-3 w-full">
                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3 file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white file:dark:text-white" type="file" name="banner"/>
            </div>
            @php
                $banner = get_images_from_folder('users',$user->id,'banner') ?? null;
                $banner = ($banner == 'default/_banner.jpg') ? null : $banner; 
            @endphp
            <img src="<?= asset('uploads/users/'.$banner) ?>" alt="" class="mt-3" />

            <x-button id="delete_file" type="button" value="danger" class="mt-2 hidden" data-folder="{{ $user->id }}"><i class="fas fa-trash-alt"></i></x-button>

            <p class="mt-3"><i>*Seleccionar una nueva imagen reemplazará la foto de banner actual.</i></p>

        </div>

    </div>
    <div class="grid grid-cols-12 gap-4 p-6">
        <x-button type="submit" class="w-fit">Guardar</x-button>
    </div>

</div>


