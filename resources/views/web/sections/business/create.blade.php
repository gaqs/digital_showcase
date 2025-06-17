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
                            <x-input-large id="input_business-name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $business->name ?? null)" placeholder="Nombre Negocio" required />
                            <span id="name_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                        </div>
                        <div class="md:col-span-1 col-span-2 mt-1">
                            <select data-te-select-init data-te-select-size="lg" data-te-select-init data-te-select-filter="true" id="categories_id" name="categories_id" required>
                                {{ category_list( old('categories_id', $business->categories_id ?? null) ) }}
                            </select>
                            <label data-te-select-label-ref>Categoría</label>
                            <span id="categories_id_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                        </div>
                        <div class="md:col-md-2 col-span-1">
                            <x-input-large id="input_business-keywords" name="keywords" type="text"
                                class="mt-1 block w-full" :value="old('keywords', $business->keywords ?? null)" placeholder="Palabras clave*" required/>
                            <div class="text-neutral-400 text-xs leading-normal ml-2">*Ingresa palabras separadas por coma (,) que describan tu negocio. Así ayudarán al motor de búsqueda a encontrar información relevante más fácilmente.</div>
                            <span id="keywords_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                        </div>
                        <div class="col-span-2">
                            <div id="wysiwyg">{!! old('description', $business->description ?? null) !!}</div>
                            <textarea id="textarea_business-description" class="hidden" name="description" placeholder="Descripcion">
                            </textarea>
                            <span id="description_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
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
                            <x-input-large id="input_business-twitter" name="x" type="url"
                                class="mt-1 block w-full" :value="old('x', $business->twitter ?? null)" placeholder="X" />
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
                        <div>
                            <x-input-large id="input_business-aliexpress" name="aliexpress" type="url"
                                class="mt-1 block w-full" :value="old('aliexpress', $business->aliexpress ?? null)" placeholder="Aliexpress" />
                        </div>
                    </div>

                </div>

                <div id="business_create_ubication" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-map-location text-rose-500"></i> Ubicación
                    </h5>
                    <div class="grid grid-cols-12 md:grid-cols-12 gap-4">

                        <!-- MAP -->
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
                            <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                <i class="fas fa-map-marker-alt text-rose-500"></i> Coordenadas
                            </h5>
                            <div id="map" class="h-96 mt-3"></div>
                            <div id="coordinates">
                                <input id="input_latitude" name="latitude" type="text" class="" value=" <?= old('latitude', $business->latitude ?? '-41.46518') ?>" placeholder="Latitud" required readonly />
                                <input id="input_longitude" name="longitude" type="text" class="" value="<?= old('longitude', $business->longitude ?? '-72.93816') ?>" placeholder="Longitud" required readonly />
                            </div>
                        </div>
                        <!-- MAP -->
                        
                        
                        <div class="col-span-12 md-col-span-6">
                            <h5 class="mt-2 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                <i class="fas fa-phone text-rose-500"></i> Datos de Contacto
                            </h5>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="relative flex flex-wrap items-stretch mt-1">
                                <span class="flex items-center whitespace-nowrap rounded-s border border-e-0 border-solid border-neutral-200 px-3 text-center text-base text-surface dark:border-white/10 dark:text-white bg-secondary-100">+569</span>
                                <x-input-large id="input_business-phone" name="phone" type="text" maxlength="12" class="" :value="old('phone', $business->phone ?? null)" placeholder="Teléfono" />
                            </div>
                            <span id="phone_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>

                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div class="relative flex flex-wrap items-stretch mt-1">
                                <span class="flex items-center whitespace-nowrap rounded-s border border-e-0 border-solid border-neutral-200 px-3 text-center text-base text-surface dark:border-white/10 dark:text-white bg-secondary-100">+569</span>
                                <x-input-large id="input_business-whatsapp" name="whatsapp" type="text" maxlength="12" class="" :value="old('whatsapp', $business->whatsapp ?? null)" placeholder="Whatsapp" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <x-input-large id="input_business-email" name="email" type="text"
                                class="mt-1 block w-full" :value="old('email', $business->email ?? null)" placeholder="Correo electrónico" required />
                            <span id="email_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <x-input-large id="input_business-email_2" name="email_2" type="text"
                                class="mt-1 block w-full" :value="old('email_2', $business->email_2 ?? null)" placeholder="Correo electrónico #2" />
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <x-input-large id="input_business-web" name="web" type="url"
                                class="mt-1 block w-full" :value="old('web', $business->web ?? null)" placeholder="Página web" />
                        </div>

                    </div>
                </div>

                <div id="business_create_gallery" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-images text-rose-500"></i> Imágenes y opciones de galería
                    </h5>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-4">
                            <label for="dz_profile" class="text-neutral-500"> Logo de empresa </label>
                            <div id="dz_profile" class="dropzone dz-clickeable grid grid-cols-1 justify-items-center">
                                @csrf
                                <div class="dz-default dz-message text-sm">
                                    <i class="fa-solid fa-upload text-5xl"></i><br>
                                    Arrastra los archivos aquí
                                </div>

                            </div>
                            <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB.</div>
                            <span id="dz_profile_error" class="text-rose-500 text-xs"></span>
                        </div>
                        <div class="col-span-12 md:col-span-8">
                            <label for="dz_gallery" class="text-neutral-500"> Galería </label>
                            <div id="dz_gallery" class="dropzone dz-clickeable grid grid-cols-3 justify-items-center">
                                @csrf
                                <div class="dz-default dz-message text-sm col-span-3">
                                    <i class="fa-solid fa-upload text-5xl"></i><br>
                                    Arrastra los archivos aquí
                                </div>

                            </div>
                            <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB. Máximo 9 imágenes.</div>
                            <span id="dz_gallery_error" class="text-rose-500 text-xs"></span>
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

        const quill = new Quill('#wysiwyg',{
            theme:'snow',
            placeholder: 'Descripcion...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'align': [] }],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });
    
        var folder = '<?= $business->folder ?? null ?>';
        var avatar = '<?= $avatar ?? null ?>';
        var images = '<?= isset($gallery) ? json_encode($gallery):null ?>';
        var gal = ( images != '') ? Object.values(JSON.parse(images)) : '';

        let form = document.getElementById('business_edit_form');
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
            maxFilesize: 20000000,
            headers: {
                'X-CSRF-TOKEN': _token
            },
            init: function(){
                this.on("sending", function(file, xhr, data) { //añade nombre carpeta si usuario edita el negocio
                    data.append( "folder", folder );
                });

                if( avatar != ''){   //añade imagen si es que el usuario edita el negocio
                    let mockFile = { name: avatar, size: 12345 };
                    this.displayExistingFile(mockFile, '/uploads/business/'+avatar);
                }
            },
            addedfiles: function(file){
                for (let i=0; i < file.length; i++) {
                    if (file[i].size > 20000000) { // This is the maximum file size in bytes
                        $('#dz_profile_error').html('El peso maximo de la imagen debe ser de 2MB');
                        file[i].previewElement.remove();
                    }
                }
            },
            removedfile: function(file){
                var r = confirm("¿Está seguro de que quiere eliminar este archivo?");
                if( r == true && folder != '' ){//elimina imagenes previamente subidas o al momento de la creacion
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('business.delete_file') }}",
                        data: { file: file.name },
                        headers: {
                            'X-CSRF-TOKEN': _token
                        },
                        success: function(data){
                            if( data ){ file.previewElement.remove(); }
                        }
                    });

                }else if( r == true ){ file.previewElement.remove(); }
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
            maxFilesize: 20000000,
            headers: {
                'X-CSRF-TOKEN': _token
            },
            init: function(){
                this.on("sending", function(file, xhr, data) { //añade nombre carpeta si usuario edita el negocio
                    data.append( "folder", folder );
                });

                if( gal != '' ){ //añade imagenes si es que el usuario edita el negocio
                    gal.forEach(x => {
                        let mockFile = { name: x, size: 12345 };
                        this.displayExistingFile(mockFile, '/uploads/business/'+folder+'/'+x);
                    });
                }
            },
            addedfiles: function(file){
                for (let j=0; j < file.length; j++) {
                    if (file[j].size > 20000000) { // This is the maximum file size in bytes
                        $('#dz_gallery_error').html('El peso máximo de las imágenes debe ser de 2MB');
                        file[j].previewElement.remove();
                    }
                }
            },
            removedfile: function(file){ //elimina imagenes previamente subidas o al momento de la creacion
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
                            if(data){ file.previewElement.remove(); }
                        }
                    });

                }else if( r == true && folder == ''){ file.previewElement.remove();  }
            }
        });

        var firstError = '';
        const requiredFields = document.querySelectorAll('#business_edit_form [required]');

        //vuelve a ocultar los mensajes de error cuando se ingrese informacion en los input
        requiredFields.forEach(field => {
            field.addEventListener("keydown", function(e){
                const errorSpan = document.getElementById(`${field.name}_error`);
                errorSpan.classList.add('hidden');
                firstError = '';
            });
        });

        document.querySelector("button[type=submit]").addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();

            document.getElementById('textarea_business-description').value = quill.root.innerHTML;

            //verifica que los campos esten completos
            let allFull = true;
            requiredFields.forEach(field => {
                const errorSpan = document.getElementById(`${field.name}_error`);
                if(field.value.trim() == '' || field.value == 0){
                    firstError = firstError == '' ? field : firstError;
                    allFull = false;
                    errorSpan.classList.remove('hidden');
                }
            });

            //1era vez subiendo imagenes y ambas deben estar con imagenes
            if( allFull && folder == '' ){

                if( profile.getQueuedFiles().length > 0 && gallery.getQueuedFiles().length >= 3 ){
                    profile.processQueue();
                }else{
                    alert('Por favor, asegúrate de subir al menos una imagen en perfil y minimo tres en la galeria.');
                }
            }

            //editando imagenes
            if( allFull && folder != '' ){
                if( profile.getQueuedFiles().length > 0 ){
                    profile.processQueue();
                }else if( gallery.getQueuedFiles().length > 0  ){
                    gallery.processQueue();
                }else{
                    form.submit();
                }
            }

            if (firstError) {
                firstError.scrollIntoView({
                    behavior: 'smooth',
                    block:'center'
                });
            }

        });

        profile.on("success", function(files, response) {
            if( gallery.getQueuedFiles().length > 0 ){
                gallery.processQueue();
            }else{
                form.submit();
            }
        });

        gallery.on("successmultiple", function(files, response) { form.submit(); });


    </script>
@endsection

