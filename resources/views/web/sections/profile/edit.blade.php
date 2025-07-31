@extends('web.sections.profile.layout')
@section('content')

    <section id="update_profile">
        <div class="container-xl relative pb-20">
            <header>
                <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Información de del Perfil
                </h2>
                <!--Breadcrumb-->
                <nav class="w-full rounded-md">
                    <ol class="list-reset flex">
                        <li>
                            <x-link href="#" class="text-neutral-500">Inicio</x-link>
                        </li>
                        <li>
                            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
                        </li>
                        <li>
                            <x-link href="#" class="text-rose-700">Editar Perfil</x-link>
                        </li>
                    </ol>
                </nav>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </header>

            <form id="profile_edit_form" method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-5 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-user-check text-rose-500"></i> Mi Perfil
                    </h5>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-large id="input_name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $user->name)" placeholder="Nombre" maxlength="255" required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-large id="input_lastname" name="lastname" type="text" class="mt-1 block w-full"
                                    :value="old('lastname', $user->lastname)" placeholder="Apellido" maxlength="255" required />
                                <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
                            </div>
                        </div>

                        <div>
                            <x-input-large id="input_email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $user->email)" required placeholder="Correo electrónico" maxlength="255" readonly/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            <!-- condicion validacion email
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            @endif
                            -->
                        </div>

                        <div>
                            <x-input-large id="input_phone" name="phone" type="text" class="mt-1 block w-full"
                                :value="old('phone', $profile->phone ?? '')" placeholder="Teléfono" maxlength="10"/>
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-large id="input_address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $profile->address ?? '')" placeholder="Dirección" maxlength="255"/>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-3">
                        <div>
                            <x-textarea id="textarea_description" name="description" class="mt-1 block w-full"
                                placeholder="Descripción" maxlength="2000">
                                {{ old('description', $profile->description ?? '') }}
                            </x-textarea>
                        </div>
                    </div>
                </div>

                <div class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-5 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-rss text-rose-500"></i> Mis redes sociales
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-large id="input_facebook" name="facebook" type="url" class="mt-1 block w-full"
                                :value="old('facebook', $profile->facebook ?? '')" placeholder="Facebook" maxlength="255"/>
                            <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                        </div>
                        <div>
                            <x-input-large id="input_x" name="x" type="url" class="mt-1 block w-full"
                                :value="old('x', $profile->x ?? '')" placeholder="X" maxlength="255"/>
                            <x-input-error class="mt-2" :messages="$errors->get('x')" />
                        </div>
                        <div>
                            <x-input-large id="input_instagram" name="instagram" type="url" class="mt-1 block w-full"
                                :value="old('instagram', $profile->instagram ?? '')" placeholder="Instagram" maxlength="255"/>
                            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                        </div>
                        <div>
                            <x-input-large id="input_tiktok" name="tiktok" type="url" class="mt-1 block w-full"
                                :value="old('tiktok', $profile->tiktok ?? '')" placeholder="Tiktok" maxlength="255"  />
                            <x-input-error class="mt-2" :messages="$errors->get('tiktok')" />
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-5">
                    <div class="col-span-12 md:col-span-4">
                        <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                            <h5 class="mb-2 pb-5 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                <i class="fa-solid fa-address-card text-rose-500"></i> Cambiar foto de perfil
                            </h5>
                            <div id="dz_user_avatar" class="dropzone dz-clickeable grid grid-cols-1 justify-items-center">
                                @csrf
                                <div class="dz-default dz-message text-sm">
                                    <i class="fa-solid fa-upload text-5xl"></i><br>
                                    Arrastra los archivos aquí
                                </div>
                            </div>
                            <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB.</div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-8">
                        <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                            <h5 class="mb-2 pb-5 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                <i class="fa-solid fa-image text-rose-500"></i> Cambiar foto de banner
                            </h5>
                            <div id="dz_banner_profile" class="dropzone dz-clickeable grid grid-cols-1 justify-items-center">
                                @csrf
                                <div class="dz-default dz-message text-sm">
                                    <i class="fa-solid fa-upload text-5xl"></i><br>
                                    Arrastra los archivos aquí
                                </div>
                            </div>
                            <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB.</div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-3">
                    <x-button type="submit" lass="!px-7 !pb-3 !pt-3 !text-sm !font-bold" value="danger">
                        Guardar
                    </x-button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>


        </div>
    </section>

    <script type="module">
        let form = document.getElementById('profile_edit_form');

        let avatar = new dz("#dz_user_avatar", {
            url:"{{ route('profile.avatar') }}",
            method: "post",
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            maxFiles: 1,
            dictRemoveFile: '<i class="fa-solid fa-trash-can"></i>',
            dictCancelUpload: '<i class="fa-solid fa-ban"></i>',
            paramName: 'avatar',
            autoProcessQueue: false,
            resizeWidth: 200,
            resizeHeight: 200,
            resizeMethod: 'crop',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        });

        let banner = new dz("#dz_banner_profile", {
            url:"{{ route('profile.banner') }}",
            method: "post",
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            maxFiles: 1,
            dictRemoveFile: '<i class="fa-solid fa-trash-can"></i>',
            dictCancelUpload: '<i class="fa-solid fa-ban"></i>',
            paramName: 'banner',
            autoProcessQueue: false,
            thumbnailWidth: 640,
            thumbnailHeight: 160,
            resizeWidth: 1280,
            resizeHeight: 300,
            resizeMethod: 'crop',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        });

        document.querySelector("button[type=submit]").addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();

            if( avatar.getQueuedFiles().length > 0 ){
                avatar.processQueue();
            }
            else if( banner.getQueuedFiles().length > 0 ){
                banner.processQueue();
            }else{
                form.submit();
            }
        });

        avatar.on("success", function(files, response) {
            if( banner.getQueuedFiles().length > 0 ){
                banner.processQueue();
            }else{
                form.submit();
            }
        });

        banner.on("success", function(files, response) {
            form.submit();
        });


    </script>

@endsection
