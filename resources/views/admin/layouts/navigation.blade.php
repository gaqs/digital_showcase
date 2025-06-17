<!-- Main navigation container -->
<nav class="flex-no-wrap relative flex w-full items-center justify-between bg-neutral-100 py-2 px-4 shadow-md shadow-black/5 dark:bg-gray-800 dark:shadow-black/10 lg:flex-wrap lg:justify-start lg:py-4" data-te-navbar-ref>
    <div class="flex w-full flex-wrap items-center justify-between px-3">

        <!-- Collapsible navigation container -->
        <div class="!visible flex-grow items-center lg:!flex lg:basis-auto" id="navbarSupportedContent1">
            <!-- Logo -->
            <a class="mb-4 mr-2 mt-3 flex items-center text-neutral-900 hover:text-neutral-900 focus:text-neutral-900 dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400 lg:mb-0 lg:mt-0" href="#" data-te-offcanvas-toggle data-te-target="#offcanvasExample" aria-controls="offcanvasExample" data-te-ripple-init data-te-ripple-color="light">
                <i class="fa-solid fa-bars"></i>
            </a>
        </div>

        <!-- Right elements -->
        <div class="relative flex items-center">
            
            <!-- switch dark mode #testing -->
            <div class="mr-5">
                <label class="inline-block pr-0.5 hover:cursor-pointer" for="dark_mode_switch"><i class="fas fa-sun"></i></label>
                <input class="mx-2 mt-[0.3rem] h-3.5 w-8 appearance-none rounded-[0.4375rem] bg-black/25 before:pointer-events-none before:absolute before:h-3.5 before:w-3.5 before:rounded-full before:bg-transparent before:content-[''] after:absolute after:z-[2] after:-mt-[0.1875rem] after:h-5 after:w-5 after:rounded-full after:border-none after:bg-white after:shadow-switch-2 after:transition-[background-color_0.2s,transform_0.2s] after:content-[''] checked:bg-primary checked:after:absolute checked:after:z-[2] checked:after:-mt-[3px] checked:after:ms-[1.0625rem] checked:after:h-5 checked:after:w-5 checked:after:rounded-full checked:after:border-none checked:after:bg-primary checked:after:shadow-switch-1 checked:after:transition-[background-color_0.2s,transform_0.2s] checked:after:content-[''] hover:cursor-pointer focus:outline-none focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-switch-3 focus:before:shadow-black/60 focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-5 focus:after:w-5 focus:after:rounded-full focus:after:content-[''] checked:focus:border-primary checked:focus:bg-primary checked:focus:before:ms-[1.0625rem] checked:focus:before:scale-100 checked:focus:before:shadow-switch-3 checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] dark:bg-white/25 dark:after:bg-surface-dark dark:checked:bg-primary dark:checked:after:bg-primary" type="checkbox" role="switch" id="dark_mode_switch">
                <label class="inline-block ps-0.5 hover:cursor-pointer" for="dark_mode_switch"><i class="fas fa-moon"></i></label>
            </div>
            

            <!-- User secction -->
            <div class="relative" data-te-dropdown-ref>
                <!-- Second dropdown trigger -->
                <a class="hidden-arrow flex items-center whitespace-nowrap transition duration-150 ease-in-out motion-reduce:transition-none" href="#" id="admin_dropdown" role="button" data-te-dropdown-toggle-ref aria-expanded="false">

                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-lg select-none bg-black mr-1">{{ substr(Auth::user()->name,0,1) }}</div>

                    {{ Auth::user()->name.' '.Auth::user()->lastname }} <i class="fas fa-caret-down ml-2"></i>

                </a>
                <!-- Second dropdown menu -->
                <ul class="absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block" aria-labelledby="admin_dropdown" data-te-dropdown-menu-ref>
                    <li>
                        <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                            href="#" data-te-dropdown-item-ref>Profile</a>
                    </li>
                    <li>
                        <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                            href="{{ route('admin.logout') }}" data-te-dropdown-item-ref>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
