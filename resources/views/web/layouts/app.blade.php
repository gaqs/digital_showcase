<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Digital Showcase') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap" rel="stylesheet">

        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/js/app.js'])

        <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=1.1">
        <link rel="stylesheet" href="{{ asset('css/share-buttons.css') }}">

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('web.layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @include('web.layouts.footer')
    </body>
</html>
<script src="{{ asset('js/scripts.js') }}"></script>
<script src="{{ asset('js/share-buttons.js') }}"></script>
<script>

    //save and delete business on profile

    window.addEventListener('load', function() {

    var button = document.getElementById('save');
    var _token = $('meta[name="csrf-token"]').attr('content');

    if(button){
        button.addEventListener('click', function(){
            var id = button.getAttribute('data-id');
            var type = button.getAttribute('data-type');

            if( button.classList.contains("button_secondary") ){
                $.ajax({
                    type: 'POST',
                    url: "{{ route('profile.save') }}",
                    data: 'id='+id+'&type='+type,
                    headers: {
                        'X-CSRF-TOKEN': _token
                    },
                    success: function(data){
                        button.classList.replace('button_secondary', 'button_primary');
                        button.children[0].classList.replace('fa-regular', 'fa-solid');
                    }
                });
            }else if(button.classList.contains("button_primary")){
                $.ajax({
                    type: 'POST',
                    url: "{{ route('profile.delete_save') }}",
                    data: 'id='+id+'&type='+type,
                    headers: {
                        'X-CSRF-TOKEN': _token
                    },
                    success: function(data){
                        button.classList.replace('button_primary', 'button_secondary');
                        button.children[0].classList.replace('fa-solid', 'fa-regular');
                    }
                });
            }

        });
    }

});
</script>
