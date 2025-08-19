@extends('web.sections.profile.layout')
@section('content')

    <section id="update_trade">
        <div class="container-xl relative pb-20">
            <header>
                <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    Información de del Oficio Tradicional
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
                            <x-link href="#" class="text-rose-700">Editar Oficio</x-link>
                        </li>
                    </ol>
                </nav>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Update your account's trade information and email address.") }}
                </p>
            </header>

           <form id="trade_edit_form" method="post" enctype="multipart/form-data" action="#" class="mt-6 space-y-6">

                <div class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-user-check text-rose-500"></i> Datos básicos del oficio
                    </h5>

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-4">
                            <x-input-large id="input_name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $trade_skill->name ?? null)" placeholder="Nombre" maxlength="255" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <x-input-large id="input_lastname" name="lastname" type="text" class="mt-1 block w-full"
                                :value="old('lastname', $trade_skill->lastname?? null)" placeholder="Apellido" maxlength="255" required />
                            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <x-input-large id="input_email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $trade_skill->email?? null)" required placeholder="Correo electrónico" maxlength="255" required/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <div class="relative flex flex-nowrap items-stretch mt-1">
                                <span class="flex items-center whitespace-nowrap rounded-s border border-e-0 border-solid border-neutral-200 px-3 text-center text-base text-surface dark:border-white/10 dark:text-white bg-secondary-100">+569</span>
                                <x-input-large id="input_business-phone" name="phone" type="text" maxlength="12" class="" :value="old('phone', $trade_skill->phone ?? null)" placeholder="Teléfono" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-3">
                            <div class="relative flex flex-nowrap items-stretch mt-1">
                                <span class="flex items-center whitespace-nowrap rounded-s border border-e-0 border-solid border-neutral-200 px-3 text-center text-base text-surface dark:border-white/10 dark:text-white bg-secondary-100">+569</span>
                                <x-input-large id="input_business-whatsapp" name="whatsapp" type="text" maxlength="12" class="" :value="old('whatsapp', $trade_skills->whatsapp ?? null)" placeholder="Whatsapp" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <x-input-large id="input_address" name="address" type="text" class="mt-1 block w-full"
                                :value="old('address', $trade_skill->address ?? null)" placeholder="Dirección" maxlength="255"/>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-5">
                        <div>
                            <div id="wysiwyg">{!! old('description', $trade_skill->description ?? null) !!}</div>
                            <textarea maxlength="2000" id="textarea_trade-description" name="description" class="hidden"></textarea>
                            <span id="description_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                        </div>
                    </div>
                </div>

                <div class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                    <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                        <i class="fa-solid fa-rss text-rose-500"></i> Mis redes sociales
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-large id="input_facebook" name="facebook" type="url" class="mt-1 block w-full"
                                :value="old('facebook', $trade_skill->facebook ?? '')" placeholder="Facebook" maxlength="255"/>
                            <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                        </div>
                        <div>
                            <x-input-large id="input_x" name="x" type="url" class="mt-1 block w-full"
                                :value="old('x', $trade_skill->x ?? '')" placeholder="X" maxlength="255"/>
                            <x-input-error class="mt-2" :messages="$errors->get('x')" />
                        </div>
                        <div>
                            <x-input-large id="input_instagram" name="instagram" type="url" class="mt-1 block w-full"
                                :value="old('instagram', $trade_skill->instagram ?? '')" placeholder="Instagram" maxlength="255"/>
                            <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                        </div>
                        <div>
                            <x-input-large id="input_tiktok" name="tiktok" type="url" class="mt-1 block w-full"
                                :value="old('tiktok', $trade_skill->tiktok ?? '')" placeholder="Tiktok" maxlength="255"  />
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
                            <div id="dz_avatar" class="dropzone dz-clickeable grid grid-cols-1 justify-items-center">
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
                            <div id="dz_banner" class="dropzone dz-clickeable grid grid-cols-1 justify-items-center">
                                @csrf
                                <div class="dz-default dz-message text-sm">
                                    <i class="fa-solid fa-upload text-5xl"></i><br>
                                    Arrastra los archivos aquí
                                </div>
                            </div>
                            <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB.</div>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <div class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                            <h5 class="mb-2 pb-5 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                                <i class="fa-solid fa-address-card text-rose-500"></i> Galería
                            </h5>
                            <div id="dz_gallery" class="dropzone dz-clickeable grid grid-cols-1 justify-items-center">
                                @csrf
                                <div class="dz-default dz-message text-sm">
                                    <i class="fa-solid fa-upload text-5xl"></i><br>
                                    Arrastra los archivos aquí
                                </div>
                            </div>
                            <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB.</div>
                            <span id="dz_gallery_error" class="text-rose-500 text-xs"></span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-3">
                    <x-button type="submit" lass="!px-7 !pb-3 !pt-3 !text-sm !font-bold" value="danger">
                        Guardar
                    </x-button>

                    @if (session('status') === 'trade-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </div>


        </div>
    </section>

    <script type="module">

        let id      = "{{ $trade->id ?? 0 }}";
        let avatar  = "{{ $avatar ?? null }}";
        let banner  = "{{ $banner ?? null }}";
        let gallery = @json($gallery ?? []);

        var _token = $('meta[name="csrf-token"]').attr('content');
        
        const wysiwyg = document.getElementById('wysiwyg');
        const quill = new Quill('#wysiwyg',{
            theme:'snow',
            placeholder: 'Descripción...',
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

        const requiredFields = document.querySelectorAll('#trade_edit_form [required]');

        //submit form via ajax a business/store
        document.querySelector("button[type=submit]").addEventListener("click", function(e) {

            e.preventDefault();
            e.stopPropagation();
        
            //verificar que todos los campos esten llenos, incluso las imagenes
            let formStatus = true;
            let imageStatus = true;

            requiredFields.forEach(field => {
                const errorSpan = document.getElementById(`${field.name}_error`);
                if(field.value.trim() == '' || field.value == 0){
                    formStatus = false;
                    errorSpan.classList.remove('hidden');
                }
            });

            //si id es 0, nuevo business. Debe subir por obligacion una imagen de perfil y minimo 3 imagenes en la galeria
            if( id == 0 ){
                if( dzAvatar.getQueuedFiles().length < 1 || dzBanner.getQueuedFiles().length < 3 || dzGallery.getQueuedFiles().length < 3 ){
                    imageStatus = false;
                    alert('Por favor, asegúrate de subir al menos una imagen en perfil, un banner y minimo tres en la galeria.');
                }
            }
            
            //si formulario esta completo e imagenes subidas, enviar formulario via ajax y recuperar id del negocio
            if( formStatus && imageStatus ){
                const form = document.getElementById('trade_edit_form');
                const formData = new FormData(form);
                //adjuntar al form el name "description" con el contenido del editor quill
                formData.append('description',quill.root.innerHTML);

                //deerminar metodo http
                const isCreate = "{{ request()->routeIs('trade.create') }}";
                let url;
                if( isCreate ){
                    url = "{{ route('trade.store') }}";
                }else{
                    url = "{{ route('trade.update', $trade->id ?? 0 ) }}";
                    formData.append('_method', 'PATCH');
                }

                //enviar formulario via ajax
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    headers: { 'X-CSRF-TOKEN': _token },
                    success: function(data){
                        //recueprar id business guardada
                        id = data.business_id;
                        //comienza a subir iamgenes
                        if( dzAvatar.getQueuedFiles().length > 0 ){
                            dzAvatar.processQueue();
                        }
                        if( dzGallery.getQueuedFiles().length > 0  ){
                            dzGallery.processQueue();
                        }
                        if( dzBanner.getQueuedFiles().length > 0  ){
                            dzBanner.processQueue();
                        }
                        if( isCreate ){
                            window.location.href = "/trade/"+id; //redirecciona al negocio subido
                        }else{
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                        
                    }
                });
            }
        });

        let dzAvatar = new dz("#dz_avatar", {
            url:"{{ route('trade.avatar') }}",
            method: "post",
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            maxFiles: 1,
            dictRemoveFile: '<i class="fa-solid fa-trash-can"></i>',
            dictCancelUpload: '<i class="fa-solid fa-ban"></i>',
            paramName: 'avatar',
            autoProcessQueue: false,
            resizeWidth: 500,
            resizeHeight: 500,
            resizeMethod: 'contain',
            maxFilesize: 20000000,
            headers: {
                'X-CSRF-TOKEN': _token
            },
            init: function(){
                this.on("sending", function(file, xhr, data) { //añade nombre carpeta si usuario edita el negocio
                    data.append( "id",  id);
                });

                if( avatar != ''){   //añade imagen si es que el usuario edita el negocio
                    let mockFile = { name: avatar, size: 12345 };
                    this.displayExistingFile(mockFile, '/uploads/trades/'+avatar);
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
                if( r == true ){//elimina imagenes previamente subidas o al momento de la creacion
                    $.ajax({
                        type: "POST",
                        url: "{{ route('trade.delete_file') }}",
                        data: { file: file.name },
                        headers: {
                            "X-CSRF-TOKEN": _token
                        },
                        success: function(data){
                            if( data ){ file.previewElement.remove(); }
                        }
                    });

                }else if( r == true ){ file.previewElement.remove(); }
            }
        });

        let dzBanner = new dz("#dz_banner", {
            url:"{{ route('trade.banner') }}",
            method: "post",
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            maxFiles: 1,
            dictRemoveFile: '<i class="fa-solid fa-trash-can"></i>',
            dictCancelUpload: '<i class="fa-solid fa-ban"></i>',
            paramName: 'banner',
            autoProcessQueue: false,
            resizeWidth: 1280,
            resizeHeight: 300,
            resizeMethod: 'contain',
            maxFilesize: 20000000,
            headers: {
                'X-CSRF-TOKEN': _token
            },
            init: function(){
                this.on("sending", function(file, xhr, data) { //añade nombre carpeta si usuario edita el negocio
                    data.append( "id",  id);
                });

                if( banner != ''){   //añade imagen si es que el usuario edita el negocio
                    let mockFile = { name: banner, size: 12345 };
                    this.displayExistingFile(mockFile, '/uploads/trades/'+banner);
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
                if( r == true ){//elimina imagenes previamente subidas o al momento de la creacion
                    $.ajax({
                        type: "POST",
                        url: "{{ route('trade.delete_file') }}",
                        data: { file: file.name },
                        headers: {
                            "X-CSRF-TOKEN": _token
                        },
                        success: function(data){
                            if( data ){ file.previewElement.remove(); }
                        }
                    });

                }else if( r == true ){ file.previewElement.remove(); }
            }
        });

        let dzGallery = new dz("#dz_gallery", {
            url:"{{ route('trade.gallery') }}",
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
                this.on("sending", function(file, xhr, data) { //añade nombre carpeta (id) si usuario edita el negocio
                    data.append( "id", id );
                });

                if( gallery != '' ){ //añade imagenes si es que el usuario edita el negocio
                    gallery = JSON.parse(gallery);
                    gallery.forEach(x => {
                        let mockFile = { name: x };
                        this.displayExistingFile(mockFile, '/uploads/trades/'+id+'/'+x);
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
                if( r == true && id != '' ){
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('trade.delete_file') }}",
                        data: { file: id+'/'+file.name },
                        headers: {
                            'X-CSRF-TOKEN': _token
                        },
                        success: function(data){
                            if(data){ file.previewElement.remove(); }
                        }
                    });

                }else if( r == true ){ file.previewElement.remove();  }
            }
        });
    </script>


@endsection
