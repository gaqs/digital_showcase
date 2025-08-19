@extends('web.sections.profile.layout')
@section('content')

<section id="create_product">
    <div class="container-xl relative pb-20">
        <header>
            <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                {{ request()->routeIs('product.create') ? 'Crear Producto' : 'Editar Producto' }}
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
                        <x-link href="#" class="text-rose-700">Crear producto</x-link>
                    </li>
                </ol>
            </nav>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>

        <form id="product_edit_form" method="post" enctype="multipart/form-data" action="#" class="mt-6 space-y-6">

            <div id="product_create_information" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                    <i class="fa-solid fa-circle-info text-rose-500"></i> Información producto
                </h5>

                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <x-input-large id="input_product-name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name ?? null)" placeholder="Nombre producto" required />
                        <span id="name_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                    </div>
                    <div class="col-span-8 mt-1">
                        <select data-te-select-init data-te-select-size="lg" id="business_id" name="business_id" {{ isset($product->business_id) ? 'disabled':'' }} required>
                            {{ business_list_per_id(old('business_id', $product->business_id ?? null), Auth::user()->id ) }}
                        </select>
                        <div class="text-neutral-400 text-xs leading-normal ml-2">*Seleccione en este listado uno de sus tiendas, la cual venderá el producto que va a ingresar.</div>
                        <span id="business_id_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                    </div>

                    <div class="col-span-4">
                        <div>
                            <x-input-large id="input_product-stock" name="stock" type="number" class="mt-1 block w-full" :value="old('stock', $product->stock ?? null)" placeholder="Stock" required/>
                            <span id="stock_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                        </div>
                    </div>

                    <div class="col-span-6 mb-3 mt-1">
                        <select data-te-select-init data-te-select-size="lg" data-te-select-init data-te-select-filter="true"  id="categories_id" name="categories_id" required>
                            {{ category_list( old('categories_id', $product->categories_id ?? null) ) }}
                        </select>
                        <span id="categories_id_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                    </div>

                    <div class="col-span-6">
                        <x-input-large id="input_product-price" name="price" type="text"
                            class="mt-1 block w-full" oninput="formatearPrecio(this)" :value="old('price', $product->price ?? null)" placeholder="Precio"
                            required />
                        <span id="price_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                    </div>

                    <div class="col-span-12 mb-3">
                        <div id="wysiwyg">{!! old('description', $product->description ?? null) !!}</div>
                        <textarea maxlength="2000" id="textarea_product-description" name="description" class="hidden"></textarea>
                        <span id="description_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                    </div>
                </div>
            </div>

            <div id="product_create_social" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                    <i class="fa-solid fa-share-nodes text-rose-500"></i> Redes sociales
                </h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-large id="input_product-mercadolibre" name="mercadolibre" type="url"
                            class="mt-1 block w-full" :value="old('mercadolibre', $product->mercadolibre ?? null)" placeholder="Mercado Libre" />
                    </div>
                    <div>
                        <x-input-large id="input_product-facebook" name="facebook" type="url"
                            class="mt-1 block w-full" :value="old('facebook', $product->facebook ?? null)" placeholder="Facebook" />
                    </div>
                    <div>
                        <x-input-large id="input_product-yapo" name="yapo" type="url"
                            class="mt-1 block w-full" :value="old('yapo', $product->yapo ?? null)" placeholder="Yapo" />
                    </div>
                    <div>
                        <x-input-large id="input_product-aliexpress" name="aliexpress" type="url"
                            class="mt-1 block w-full" :value="old('aliexpress', $product->aliexpress ?? null)" placeholder="Aliexpress" />
                    </div>
                </div>

            </div>

            <div id="product_gallery" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                    <i class="fa-solid fa-images text-rose-500"></i> Galería
                </h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label for="dz_gallery" class="text-neutral-500"> Imágenes </label>
                        <div id="dz_gallery" class="dropzone dz-clickeable text-center" name="dz_product">
                            @csrf
                            <div class="dz-default dz-message text-sm">
                                <i class="fa-solid fa-upload text-5xl"></i><br>
                                Arrastra los archivos aquí
                            </div>

                        </div>
                        <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB.</div>
                        <span id="dz_gallery_error" class="text-rose-500 text-xs dz_product_error"></span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4 mt-3">
                <x-button type="submit" class="!px-7 !pb-3 !pt-3 !text-sm !font-bold" value="danger">{{ __('Save') }}</x-button>
            </div>

        </form>

    </div>
</section>
<script type="module">

    let id      = "{{ $product->id ?? 0 }}";
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

    //campos form obligatorios
    const requiredFields = document.querySelectorAll('#product_edit_form [required]');
    const businessWrapper = document.querySelector('#business_id'); //verificar select como algo aparte
    const categoryWrapper = document.querySelector('#categories_id'); 

    //vuelve a ocultar los mensajes de error cuando se ingrese informacion en los input
    requiredFields.forEach(field => {
        field.addEventListener("click", function(e){
            const errorSpan = document.getElementById(`${field.name}_error`);
            errorSpan.classList.add('hidden');
        });
    });

    //error de ambios select
    const businessError = document.getElementById('business_id_error');
    document.getElementById('business_id').addEventListener('change', function() {
        businessError.classList.add('hidden');
    });

    const categoryError = document.getElementById('categories_id_error');
    document.getElementById('categories_id').addEventListener('change', function() {
        categoryError.classList.add('hidden');
    });

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
            if( dzGallery.getQueuedFiles().length < 3 ){
                imageStatus = false;
                alert('Por favor, asegúrate de subir al menos tres en la galeria.');
            }
        }
        
        //si formulario esta completo e imagenes subidas, enviar formulario via ajax y recuperar id del negocio
        if( formStatus && imageStatus ){
            const form = document.getElementById('product_edit_form');
            const formData = new FormData(form);
            //adjuntar al form el name "description" con el contenido del editor quill
            formData.append('description',quill.root.innerHTML);

            //deerminar metodo http
            const isCreate = "{{ request()->routeIs('product.create') }}";
            let url;
            if( isCreate ){
                url = "{{ route('product.store') }}";
            }else{
                url = "{{ route('product.update', $product->id ?? 0 ) }}";
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
                    if( dzGallery.getQueuedFiles().length > 0  ){
                        dzGallery.processQueue();
                    }
                    if( isCreate ){
                        window.location.href = "/product/"+id; //redirecciona al negocio subido
                    }else{
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                        
                    }
                    
                }
            });
        }
    });

    let dzGallery = new dz("#dz_gallery", {
        url:"{{ route('product.gallery') }}",
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
                    this.displayExistingFile(mockFile, '/uploads/products/'+id+'/'+x);
                });
                
                var existingFiles = gallery.length;
                this.options.maxFiles = 9 - existingFiles; //actualiza el maximo de imagenes que se pueden subir
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
                    url: "{{ route('product.delete_file') }}",
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
