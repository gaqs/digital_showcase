<x-app-layout>
    @php
        $avatar = Auth::user()->avatar == '' ? 'uploads/users/default/_avatar.jpg' : 'uploads/users/'.Auth::user()->id.'/'.Auth::user()->avatar;
        $banner = Auth::user()->banner == '' ? 'uploads/users/default/_banner.jpg' : 'uploads/users/'.Auth::user()->id.'/'.Auth::user()->banner;
    @endphp
    <a href="{{ route('profile.edit') }}">
        <x-button class="absolute z-10 top-80 right-5" value="danger">Editar perfil</x-button>
    </a>
    <div class="relative overflow-hidden bg-cover bg-no-repeat p-20 mt-20 text-center" style="background-image: url('{{ asset($banner) }}'); height: 300px">
        <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-fixed"
            style="background-color: rgba(0, 0, 0, 0.4)">

            <div class="flex h-full items-center md:pl-40">
                <div id="avatar" class="border-8 border-danger rounded-full overflow-hidden">
                    <img src="{{ asset($avatar) }}" class="w-32 rounded-full shadow-lg" alt="Avatar" />
                </div>
                <div class="flex flex-col ml-3 text-center md:text-left">
                    <div class="text-neutral-100 text-2xl font-bold">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-neutral-100">
                        {{ Auth::user()->email }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container-xl relative md:px-20 pt-10">
        <div class="grid grid-cols-12 gap-8">

            <div clasS="col-span-12 md:col-span-3">
                <button class="group relative flex w-full items-center border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)] md:hidden"
                    type="button" data-te-collapse-init data-te-ripple-init data-te-target="#navigation_list" aria-expanded="false"
                    aria-controls="navigation_list" data-te-collapse-collapsed>
                    Navegación
                    <span class="ml-auto h-5 w-5 shrink-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                        <i class="fa-solid fa-bars"></i>
                    </span>
                </button>


                <div id="navigation_list" class="!visible hidden md:grid " data-te-collapse-item aria-labelledby="navigation">
                    <div class="block rounded-lg bg-white py-6 px-0 pl-1 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700 text-neutral-500 text-sm">
                        <div class="-mr-1">
                            <a href="{{ route('profile.home') }}#create_business" aria-current="true"
                                class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('profile.home') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-house"></i> Inicio
                            </a>
                            <a href="{{ route('business.index') }}#create_business" aria-current="true"
                                class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('business.index') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-building"></i> Mis negocios
                            </a>

                            <a href="{{ route('business.create') }}#create_business" class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('business.create') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-building-circle-check"></i> Crear negocio
                            </a>
                            @if ( request()->routeIs('business.create') )
                            <div>
                                <ul class="">
                                    <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-2">
                                      <a href="{{ route('business.create') }}#business_create_information" class="ml-10">Información</a>
                                    </li>
                                    <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-2">
                                      <a href="{{ route('business.create') }}#business_create_social" class="ml-10">Redes sociales</a>
                                    </li>
                                    <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-2">
                                      <a href="{{ route('business.create') }}#business_create_ubication" class="ml-10">Ubicación</a>
                                    </li>
                                    <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-2">
                                      <a href="{{ route('business.create') }}#business_create_gallery" class="ml-10">Galería</a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                            <a href="{{ route('product.index') }}#create_business" class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('product.index') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-icons"></i> Mis productos
                            </a>
                            <a href="{{ route('product.create') }}#create_product" class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('product.create') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-icons"></i> Crear producto
                            </a>
                            @if ( request()->routeIs('product.create') )
                            <div>
                                <ul class="">
                                    <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-2">
                                      <a href="{{ route('product.create') }}#business_create_information" class="ml-10">Información</a>
                                    </li>
                                    <li class="w-full border-b-2 border-neutral-100 border-opacity-100 py-2">
                                      <a href="{{ route('product.create') }}#business_create_social" class="ml-10">Galería</a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                            <a href="{{ route('profile.saved') }}" class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('profile.saved') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-building-flag"></i> Guardados
                            </a>
                            <p class="p-4 w-full text-neutral-700 font-bold border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
                                Mi Cuenta
                            </p>
                            <a href="{{ route('profile.edit') }}"
                                class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('profile.edit') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-user-pen"></i> Ver/Editar perfil
                            </a>
                            <a href="{{ route('password.home') }}"
                                class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('profile.password') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-unlock-keyhole"></i> Cambiar contraseña
                            </a>
                            <a href="#!"
                                class="block w-full cursor-pointer p-4 hover:-ml-1 hover:border-l-4 hover:border-danger-600 hover:bg-danger-100 hover:text-danger-600 {{ request()->routeIs('profile.logout') ? '-ml-1 border-l-4 border-danger-600 bg-danger-100 text-danger-600' : null }}">
                                <i class="fa-solid fa-power-off"></i> Desconectar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-9">

                @yield('content')

            </div>
        </div>
    </div>
</x-app-layout>
