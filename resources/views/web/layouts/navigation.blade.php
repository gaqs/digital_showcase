<!-- Main navigation container -->
<nav class="flex-no-wrap {{  request()->routeIs('home.index') ? 'lg:bg-transparent lg:text-white bg-white text-neutral-700' : 'bg-white text-neutral-700' }} absolute top-0 left-0 right-0 z-20 w-full items-center justify-between bg-neutral-100 py-3 dark:bg-neutral-600 dark:shadow-black/10 lg:flex-wrap lg:justify-start lg:py-5 z-30" id="navbar_top" data-te-navbar-ref>

    <div class="flex w-full flex-wrap items-center justify-between px-3 lg:px-20">
        <!-- Hamburger button for mobile view -->
        <button class="block border-0 bg-transparent px-2 text-neutral-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 dark:text-neutral-200 lg:hidden" type="button" data-te-collapse-init data-te-target="#navbar_content" aria-controls="navbar_content" aria-expanded="false" aria-label="Toggle navigation">
            <!-- Hamburger icon -->
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Logo -->
        <a class="my-1 mr-12 flex items-center hover:text-rose-600 focus:text-rose-600 lg:mb-0 lg:mt-0" href="{{ route('home.index') }}">
            <!--<img class="mr-2 h-[40px]" src="{{ asset('img/logo.png') }}" alt="" loading="lazy" />-->
            <span class="font-bold text-xl leading-none">VITRINA<br>PUERTO MONTT</span>
        </a>

        <!-- Collapsible navigation container -->
        <div class="!visible hidden flex-grow basis-[100%] items-center lg:!flex lg:basis-auto" id="navbar_content"
            data-te-collapse-item>
            <!-- Left navigation links -->
            <ul class="list-style-none mr-auto flex flex-col pl-0 lg:flex-row lg:space-x-3" data-te-navbar-nav-ref>
                <x-nav-link  :href="route('home.index')" :active="request()->routeIs('home.index')">
                    Inicio
                </x-nav-link>
                <x-nav-link  :href="route('search.show', ['option' => 0])" :active="request()->routeIs('search.show') && request()->get('option') == 0">
                    Negocios
                </x-nav-link>
                <x-nav-link  :href="route('search.show', ['option' => 1])" :active="request()->routeIs('search.show') && request()->get('option') == 1">
                    Productos
                </x-nav-link>
                <x-nav-link  href="#" >
                    Nosotros
                </x-nav-link>
                <!--
                <x-dropdown value="Negocios" type="link">
                    <x-dropdown-link href="#">prueba 1</x-dropdown-link>
                    <x-dropdown-link href="#">prueba 2</x-dropdown-link>
                    <x-dropdown-link href="#">prueba 3</x-dropdown-link>
                </x-dropdown>
                -->
            </ul>

            <!-- Right elements -->
            <div class="relative flex items-center">
                @if (Auth::check())
                    <div class="rounded-full shadow-lg bg-danger text-white px-4 py-2 font-bold">
                        {{ substr(Auth::user()->name, 0,1) }}
                    </div>
                    <x-dropdown value="{{ 'Hola '.Auth::user()->name }}" type="link">
                        <x-dropdown-link :href="route('profile.home')"><i class="fa-solid fa-user"></i> Mi perfil</x-dropdown-link>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fa-solid fa-power-off"></i> Salir
                    </x-dropdown-link>
                        </form>

                    </x-dropdown>
                @else
                    <span class="font-bold text-sm mr-3">
                        <a href="{{ route('register') }}">
                            <i class="fa-solid fa-user-plus text-danger"></i> Registrarse
                        </a>
                    </span>
                    <a href="{{ route('login') }}">
                        <x-button class="!font-bold capitalize pb-3" value="danger">
                            <i class="fa-solid fa-right-to-bracket"></i> Iniciar sesión
                        </x-button>
                    </a>
                @endif


            </div>
        </div>


    </div>
</nav>
