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

        @if (request()->routeIs('product.create'))
            <form id="product_edit_form" method="post" enctype="multipart/form-data" action="{{ route('product.store') }}" class="mt-6 space-y-6">
            @csrf
        @else
            <form id="product_edit_form" method="post" enctype="multipart/form-data" action="{{ route('product.update', ['id' => $product->id ]) }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')
        @endif

            <div id="product_create_information" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                    <i class="fa-solid fa-circle-info text-rose-500"></i> Información producto
                </h5>

                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <x-input-large id="input_product-name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name ?? null)" placeholder="Nombre producto" required />
                        <span id="name_error" class="text-rose-500 text-xs ml-3 hidden"></span>
                    </div>
                    <div class="col-span-8 mt-1">
                        <select data-te-select-init data-te-select-size="lg" id="business_id" name="business_id" required>
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
                        <select data-te-select-init data-te-select-size="lg" data-te-select-init data-te-select-filter="true"  id="category_id" name="category_id" required>
                            {{ category_list( old('category_id', $product->category_id ?? null) ) }}
                        </select>
                        <span id="category_id_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                    </div>

                    <div class="col-span-6">
                        <x-input-large id="input_product-price" name="price" type="text"
                            class="mt-1 block w-full" oninput="formatearPrecio(this)" :value="old('price', $product->price ?? null)" placeholder="Precio"
                            required />
                        <span id="price_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                    </div>

                    <div class="col-span-12 mb-3">
                        <x-textarea maxlength="2000" id="textarea_business-description" name="description"
                            placeholder="Descripcion">{{ old('description', $product->description ?? null) }}
                        </x-textarea>
                        <span id="description_error" class="text-rose-500 text-xs ml-3 hidden">Campo obligatorio</span>
                    </div>
                </div>
            </div>

            <div id="product_gallery" class="block rounded-lg bg-white p-6 mt-5 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
                <h5 class="mb-2 pb-1 font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                    <i class="fa-solid fa-images text-rose-500"></i> Galería
                </h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label for="dz_product" class="text-neutral-500"> Imágenes </label>
                        <div id="dz_product" class="dropzone dz-clickeable text-center" name="dz_product">
                            @csrf
                            <div class="dz-default dz-message text-sm">
                                <i class="fa-solid fa-upload text-5xl"></i><br>
                                Arrastra los archivos aquí
                            </div>

                        </div>
                        <div class="text-sm text-neutral-500">Tamaño máximo del archivo 2 MB.</div>
                        <span id="dz_product_error" class="text-rose-500 text-xs ml-3 hidden">Agregue al menos una imagen.</span>
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
    let _token = $('meta[name="csrf-token"]').attr('content');
    let form = document.getElementById('product_edit_form');
    var folder = '<?= $product->folder ?? null ?>';
    var images = '<?= json_encode($gallery ?? null) ?>';
    var gal = ( images != 'null') ? Object.values(JSON.parse(images)) : '';

    let gallery = new dz("#dz_product", {
        url:"{{ route('product.gallery') }}",
        method: "post",
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        maxFiles: 4,
        dictRemoveFile: '<i class="fa-solid fa-trash-can"></i>',
        dictCancelUpload: '<i class="fa-solid fa-ban"></i>',
        paramName: 'gallery',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 4,
        maxFilesize: 3000000,
        resizeWidth: 800,
        resizeHeight: 700,
        resizeMethod: 'crop',
        headers: {
            'X-CSRF-TOKEN': _token
        },
        init: function(){

            this.on("sending", function(file, xhr, data) {
                let select = document.querySelector('[name="business_id"]').value;

                data.append("folder", folder );
                data.append("business_id", select );
            });

            if( gal != '' ){
                gal.forEach(x => {
                    let mockFile = { name: x, size: 12345 };
                    this.displayExistingFile(mockFile, '/uploads/products/'+folder+'/'+x);
                });
            }
        },
        removedfile: function(file){
            var r = confirm("¿Está seguro de que quiere eliminar este archivo?");
            if( r == true && folder != '' ){
                $.ajax({
                    type: 'POST',
                    url: "{{ route('product.delete_file') }}",
                    data: { file: folder+'/'+file.name },
                    headers: {
                        'X-CSRF-TOKEN': _token
                    },
                    success: function(data){
                        file.previewElement.remove();
                    }
                });

                file.previewElement.remove();

            }
        }
    });

    var firstError = '';
    var fields = document.querySelectorAll('#product_edit_form input, #product_edit_form select, #product_edit_form textarea');

    //vuelve a ocultar los mensajes de error cuando se ingrese informacion en los input
    fields.forEach(field => {
        field.addEventListener("keydown", function(e){
            const errorSpan = document.getElementById(`${field.name}_error`);
            errorSpan.classList.add('hidden');
            firstError = '';
        });
    });

    document.querySelector("button[type=submit]").addEventListener("click", function(e) {
        e.preventDefault();
        e.stopPropagation();

        //validacion de datos y agrega error si no esta lleno, ademas valida si todo esta
        let completeForm = true;
        fields.forEach(field => {
            const errorSpan = document.getElementById(`${field.name}_error`);
            if (field.value.trim() === '' || field.value == 0) {
                firstError = firstError == '' ? field : firstError;
                completeForm = false
                errorSpan.classList.remove('hidden');
            }
        });

        if(completeForm){
            if( gallery.getQueuedFiles().length > 0 ){
                gallery.processQueue();
            }else{
                var image_error = document.querySelector('#dz_product_error');
                image_error.classList.remove('hidden');
                //form.submit();
            }
        }

        //hace scroll hasta hacer visible el primer error que se guarda en la revicion anterior
        if (firstError) {
            firstError.scrollIntoView({
                behavior: 'smooth',
                block:'center'
            });
        }

    });

    gallery.on("successmultiple", function(files, response) {
        form.submit();
    });




</script>
@endsection
