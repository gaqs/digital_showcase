@extends('web.sections.profile.layout')
@section('content')
    <section id="create_business">
        <div class="container-xl relative pb-20">
            <header>
                <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    {{ request()->routeIs('business.create') ? 'Crear Negocio' : 'Editar Negocio' }}
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
                            <x-link href="#" class="text-neutral-500">Mis negocios</x-link>
                        </li>
                        <li>
                            <span class="mx-2 text-neutral-500 dark:text-neutral-400">/</span>
                        </li>
                        <li>
                            <x-link href="#" class="text-rose-700"> {{ request()->routeIs('business.create') ? 'Crear negocio' : 'Editar negocio' }}</x-link>
                        </li>
                    </ol>
                </nav>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Asegurese de que su informacion sea precisa, agrega detalles adicionales, descripción, horario de atención, y fotografías.
                </p>
            </header>

            @if (request()->routeIs('business.create'))
                <form id="business_edit_form" method="post" enctype="multipart/form-data" action="{{ route('business.store') }}" class="mt-6 space-y-6">
                @csrf
            @else
                <form id="business_edit_form" method="post" enctype="multipart/form-data" action="{{ route('business.update', ['id' => $business->id ]) }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')
            @endif

                <div id="business_create_information" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-circle-info text-rose-500"></i> Información negocio
                    </h5>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <x-input-large id="input_business-name" name="name" type="text"
                                class="mt-1 block w-full" :value="old('name', $business->name ?? null)" placeholder="Nombre negocio" required />
                        </div>
                        <div class="mt-1">
                            <select data-te-select-init data-te-select-size="lg" data-te-select-init data-te-select-filter="true" id="category_id" name="category_id">
                                {{ category_list( old('category_id', $business->category_id ?? null) ) }}
                            </select>
                            <label data-te-select-label-ref>Categoría</label>
                        </div>
                        <div>
                            <x-input-large id="input_business-keywords" name="keywords" type="text"
                                class="mt-1 block w-full" :value="old('keywords', $business->keywords ?? null)" placeholder="Palabras clave*" />
                            <div class="text-neutral-400 text-xs leading-normal ml-2">*Ingresa palabras separadas por coma (,) que describan tu negocio. Así ayudarán al motor de búsqueda a encontrar información relevante más fácilmente.</div>
                        </div>
                        <div class="col-span-2">
                            <x-textarea id="textarea_business-description" name="description" placeholder="Descripcion" required>{{ old('description', $business->description ?? null) }}
                            </x-textarea>
                        </div>
                    </div>
                </div>

                <div id="business_create_social" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-share-nodes text-rose-500"></i> Redes sociales
                    </h5>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-large id="input_business-facebook" name="facebook" type="url"
                                class="mt-1 block w-full" :value="old('facebook', $business->facebook ?? null)" placeholder="Facebook" />
                        </div>
                        <div>
                            <x-input-large id="input_business-twitter" name="twitter" type="url"
                                class="mt-1 block w-full" :value="old('twitter', $business->twitter ?? null)" placeholder="Twitter" />
                        </div>
                        <div>
                            <x-input-large id="input_business-instagram" name="instagram" type="url"
                                class="mt-1 block w-full" :value="old('instagram', $business->instagram ?? null)" placeholder="Instagram" />
                        </div>
                        <div>
                            <x-input-large id="input_business-tiktok" name="tiktok" type="url"
                                class="mt-1 block w-full" :value="old('tiktok', $business->tiktok ?? null)" placeholder="Tiktok" />
                        </div>
                        <div>
                            <x-input-large id="input_business-mercadolibre" name="mercadolibre" type="url"
                                class="mt-1 block w-full" :value="old('mercadolibre', $business->mercadolibre ?? null)" placeholder="Mercado Libre" />
                        </div>
                        <div>
                            <x-input-large id="input_business-yapo" name="yapo" type="url"
                                class="mt-1 block w-full" :value="old('yapo', $business->yapo ?? null)" placeholder="Yapo" />
                        </div>

                    </div>

                </div>

                <div id="business_create_ubication" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-map-location text-rose-500"></i> Ubicación
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <div class="col-span-2">
                                <x-input-large id="input_address" name="address" type="text"
                                    class="mt-1 block w-full" :value="old('address', $business->address ?? null)" placeholder="Dirección"
                                    required />
                            </div>

                            <div id="map" class="h-80 mt-3"></div>
                            <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&libraries=places&v=weekly" defer></script>

                        </div>
                        <div class="hidden">
                            <x-input-large id="input_latitude" name="latitude" type="text"
                                class="mt-1 block w-full" :value="old('latitude', $business->latitude ?? '-41.46518')" placeholder="Latitud"
                                required readonly />
                        </div>
                        <div class="hidden">
                            <x-input-large id="input_longitude" name="longitude" type="text"
                                class="mt-1 block w-full" :value="old('longitude', $business->longitude ?? '-72.93816')" placeholder="Longitud"
                                required readonly />
                        </div>
                        <div>
                            <x-input-large id="input_business-phone_1" name="phone" type="text"
                                class="mt-1 block w-full" :value="old('phone', $business->phone ?? null)" placeholder="Teléfono"
                                required />
                        </div>
                        <div>
                            <x-input-large id="input_business-phone_2" name="phone_2" type="text"
                                class="mt-1 block w-full" :value="old('phone_2', $business->phone_2 ?? null)" placeholder="Teléfono #2" />
                        </div>
                        <div>
                            <x-input-large id="input_business-email" name="email" type="text"
                                class="mt-1 block w-full" :value="old('email', $business->email ?? null)" placeholder="Correo electrónico"
                                required />
                        </div>
                        <div>
                            <x-input-large id="input_business-email_2" name="email_2" type="text"
                                class="mt-1 block w-full" :value="old('email_2', $business->email_2 ?? null)" placeholder="Correo electrónico #2" />
                        </div>
                        <div class="col-span-2">
                            <x-input-large id="input_business-web" name="web" type="text"
                                class="mt-1 block w-full" :value="old('web', $business->web ?? null)" placeholder="Página web" />
                        </div>

                    </div>
                </div>

                <div id="business_create_gallery" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-images text-rose-500"></i> Imágenes y opciones de galería
                    </h5>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-4">
                            <label for="dz_profile" class="text-neutral-500"> Logo de empresa </label>
                            <div id="dz_profile" class="dropzone dz-clickeable grid grid-cols-1 justify-items-center">
                                @csrf
                                <div class="dz-default dz-message text-sm">
                                    <i class="fa-solid fa-upload text-5xl"></i><br>
                                    Arrastra los archivos aquí
                                </div>

                            </div>
                            <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB.</div>
                        </div>
                        <div class="col-span-8">
                            <label for="dz_gallery" class="text-neutral-500"> Galería </label>
                            <div id="dz_gallery" class="dropzone dz-clickeable grid grid-cols-3 justify-items-center">
                                @csrf
                                <div class="dz-default dz-message text-sm col-span-3">
                                    <i class="fa-solid fa-upload text-5xl"></i><br>
                                    Arrastra los archivos aquí
                                </div>

                            </div>
                            <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB. Máximo 9 imágenes.</div>
                        </div>

                        <div class="flex items-center gap-4 mt-3">
                            <x-button type="submit" class="!px-7 !pb-3 !pt-3 !text-sm !font-bold" value="danger">{{ __('Save') }}</x-button>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </section>

    <script type="module">
        var folder = '<?= $business->folder ?? null ?>';
        var avatar = '<?= $avatar ?? null ?>';
        var images = '<?= json_encode($gallery ?? null) ?>';
        var gal = ( images != 'null') ? Object.values(JSON.parse(images)) : '';

        let form = document.getElementById('business_edit_form');
        let sendForm = false;

        var _token = $('meta[name="csrf-token"]').attr('content');

        let profile = new dz("#dz_profile", {
            url:"{{ route('business.avatar') }}",
            method: "post",
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            maxFiles: 1,
            dictRemoveFile: '<i class="fa-solid fa-trash-can"></i>',
            dictCancelUpload: '<i class="fa-solid fa-ban"></i>',
            paramName: 'profile',
            autoProcessQueue: false,
            resizeWidth: 500,
            resizeHeight: 500,
            resizeMethod: 'crop',
            headers: {
                'X-CSRF-TOKEN': _token
            },
            init: function(){
                this.on("sending", function(file, xhr, data) {
                    data.append( "folder", folder );
                });

                if( avatar != ''){
                    let mockFile = { name: avatar, size: 12345 };
                    this.displayExistingFile(mockFile, '/uploads/business/'+avatar);
                }
            },
            removedfile: function(file){
                var r = confirm("¿Está seguro de que quiere eliminar este archivo?");
                if( r == true && folder != '' ){
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('business.delete_file') }}",
                        data: { file: folder+'/'+file.name },
                        headers: {
                            'X-CSRF-TOKEN': _token
                        },
                        success: function(data){
                            if( data ){
                                file.previewElement.remove();
                            }

                        }
                    });
                    file.previewElement.remove();
                }
            }
        });

        let gallery = new dz("#dz_gallery", {
            url:"{{ route('business.gallery') }}",
            method: "post",
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            maxFiles: 9,
            dictRemoveFile: '<i class="fa-solid fa-trash-can"></i>',
            dictCancelUpload: '<i class="fa-solid fa-ban"></i>',
            paramName: 'gallery',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFilesize: 3000000,
            headers: {
                'X-CSRF-TOKEN': _token
            },
            init: function(){
                this.on("sending", function(file, xhr, data) {
                    data.append( "folder", folder );
                });

                if( gal != '' ){
                    gal.forEach(x => {
                        let mockFile = { name: x, size: 12345 };
                        this.displayExistingFile(mockFile, '/uploads/business/'+folder+'/'+x);
                    });
                }
            },
            removedfile: function(file){
                var r = confirm("¿Está seguro de que quiere eliminar este archivo?");
                if( r == true && folder != '' ){
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('business.delete_file') }}",
                        data: { file: folder+'/'+file.name },
                        headers: {
                            'X-CSRF-TOKEN': _token
                        },
                        sucess: function(data){
                            file.previewElement.remove();
                        }
                    });
                    file.previewElement.remove();
                }
            }
        });

        document.querySelector("button[type=submit]").addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();

            if( profile.getQueuedFiles().length > 0 ){
                profile.processQueue();
            }
            else if( gallery.getQueuedFiles().length > 0 ){
                gallery.processQueue();
            }else{
                form.submit();
            }
        });

        profile.on("success", function(files, response) {
            if( gallery.getQueuedFiles().length > 0 ){
                gallery.processQueue();
            }else{
                form.submit();
            }
        });

        gallery.on("successmultiple", function(files, response) {
            form.submit();
        });


    </script>
@endsection

