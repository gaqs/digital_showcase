<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=1.1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('admin.layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="md:px-14 px-0 mt-5">
            {{ $slot }}
        </main>

        <!-- Offcanvas menu -->
        <div class="flex space-x-2">
            <div>
                <div class="invisible fixed bottom-0 left-0 top-0 z-[1045] flex w-80 max-w-full -translate-x-full flex-col border-none bg-white bg-clip-padding text-neutral-700 shadow-sm outline-none transition duration-500 ease-in-out dark:bg-neutral-800 dark:text-neutral-200 [&[data-te-offcanvas-show]]:transform-none" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" data-te-offcanvas-init>

                    <div class="flex items-center justify-between p-4">
                        <h5 class="mb-0 font-semibold leading-normal" id="offcanvas_title"> </h5>
                        <!-- Close Offcanvas -->
                        <button type="button" class="box-content rounded-none border-none opacity-50 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-offcanvas-dismiss>
                            <span  class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled] :select-none [&.disabled]:opacity-25">
                                <i class="fas fa-times"></i>
                            </span>
                        </button>
                    </div>
                    <div class="flex-grow overflow-y-auto p-4">
                        <ul>
                            <li class="text-sm">INICIO</li>
                        </ul>
                        <ul class=" ml-5 w-100 text-surface dark:text-white">
                            <li class="w-full border-b-2 border-neutral-100 py-4 dark:border-white/10">
                               <a href="{{ route('admin.index') }}"><i class="fa-solid fa-house"></i> Home</a>
                            </li>
                        </ul>
                        <ul class="mt-10">
                            <li class="text-sm">CONTENIDO</li>
                        </ul>
                        <ul class="ml-5 w-100 text-surface dark:text-white">
                            <li class="w-full border-b-2 border-neutral-100 py-4 dark:border-white/10">
                               <a href="{{ route('admin_users.index') }}"><i class="fas fa-users mr-1"></i> Usuarios</a>
                            </li>
                            <li class="w-full border-b-2 border-neutral-100 py-4 dark:border-white/10">
                                <a href="{{ route('admin_business.index') }}"><i class="fas fa-briefcase mr-1"></i> Negocios</a>
                            </li>
                            <li class="w-full border-b-2 border-neutral-100 py-4 dark:border-white/10">
                                <a href="{{ route('admin_product.index') }}"><i class="fas fa-box mr-1"></i> Productos</a>
                            </li>
                            <li class="w-full border-b-2 border-neutral-100 py-4 dark:border-white/10">
                                <a href="{{ route('admin_trade.index') }}"><i class="fas fa-hammer mr-1"></i> Oficios</a>
                            </li>
                            <li class="w-full border-b-2 border-neutral-100 py-4 dark:border-white/10">
                                <a href="{{ route('admin_comment.index') }}"><i class="fas fa-comments mr-1"></i> Comentarios</a>
                            </li>
                        </ul>

                        <ul class="ml-5 mt-10">
                            <li>
                                <a href="{{ route('home.index') }}">
                                    <i class="fas fa-long-arrow-alt-left"></i> Volver a la web
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </div>
</body>


</html>
<script src="{{ asset('js/scripts.js') }}"></script>
<script type="module">
    const quill = new Quill('#admin_wysiwyg',{
            theme:'snow',
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

    let form = document.getElementById('form');
        
    document.querySelector("button[type=submit]").addEventListener("click", function(e) {
        e.preventDefault();
        e.stopPropagation();

        document.getElementById('description').value = quill.root.innerHTML;

        form.submit();
    });


    /* Global admin delete files from business, products and trades gallery */
    let deleteButton = document.querySelectorAll('#delete_file');

    if (deleteButton.length > 0) {
        deleteButton.forEach( button => {
            button.addEventListener('click', function(e){
                var r = confirm("¿Está seguro de que quiere eliminar este archivo?");
                if (r){
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    let fileRoute = this.getAttribute('data-file');
                    let type = this.getAttribute('data-type');  
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin_home.delete_file') }}", 
                        data: { file: fileRoute, type: type},
                        headers: {
                            'X-CSRF-TOKEN': _token
                        },
                        success: function(data){
                            location.reload();
                        }
                    });
                }
            });
        });
    }
    

</script>
