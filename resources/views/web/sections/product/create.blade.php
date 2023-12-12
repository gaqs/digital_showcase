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
                        <x-input-large id="input_product-name" name="name" type="text"
                            class="mt-1 block w-full" :value="old('name', $product->name ?? null)" placeholder="Nombre producto" required />
                    </div>
                    <div class="col-span-8 mt-1">
                        <select data-te-select-init data-te-select-size="lg" id="business_id" name="business_id">
                            {{ business_list_per_id(old('business_id', $product->business_id ?? null), Auth::user()->id ) }}
                        </select>
                        <div class="text-neutral-400 text-xs leading-normal ml-2">*Seleccione en este listado uno de sus tiendas, la cual venderá el producto que va a ingresar.</div>
                    </div>
                    <div class="col-span-4">
                        <div>
                            <x-input-large id="input_product-stock" name="stock" type="number"
                                class="mt-1 block w-full" :value="old('stock', $product->stock ?? null)" placeholder="Stock"/>
                        </div>
                    </div>
                    <div class="col-span-6 mb-3 mt-1">
                        <select data-te-select-init data-te-select-size="lg" data-te-select-init data-te-select-filter="true"  id="category_id" name="category_id">
                            {{ category_list( old('category_id', $product->category_id ?? null) ) }}
                        </select>
                    </div>
                    <div class="col-span-6">
                        <x-input-large id="input_product-price" name="price" type="text"
                            class="mt-1 block w-full" oninput="formatearPrecio(this)" :value="old('price', $product->price ?? null)" placeholder="Precio"
                            required />
                    </div>
                    <div class="col-span-12">
                        <x-textarea id="textarea_business-description" name="description"
                            placeholder="Descripcion">{{ old('description', $product->description ?? null) }}
                        </x-textarea>
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
                        <div id="dz_product" class="dropzone dz-clickeable text-center ">
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
                <x-button type="submit" class="!px-7 !pb-3 !pt-3 !text-sm !font-bold" value="danger">{{ __('Save') }}</x-button>
            </div>

        </form>


    </div>
</section>
<script type="module">
    let _token = $('meta[name="csrf-token"]').attr('content');
    let form = document.getElementById('product_edit_form');
    let select = document.querySelector('[name="business_id"]').value;

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
