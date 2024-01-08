@if (session()->has('status'))
    @if (session('status') == 'success')
        <div class="fixed top-24 right-8 z-50 pointer-events-auto mx-auto mb-4 hidden w-96 max-w-full rounded-lg bg-success-100 bg-clip-padding text-success-700 shadow-lg shadow-black/5 data-[te-toast-show]:block data-[te-toast-hide]:hidden animate__animated animate__slideInRight animate__faster" id="static-example" role="alert" aria-live="assertive" aria-atomic="true" data-te-autohide="true"
            data-te-toast-init data-te-toast-show>

            <div class="flex items-center justify-between rounded-t-lg bg-success-100 bg-clip-padding px-4 pb-2 pt-2.5">
                <p class="flex items-center font-bold text-success-700">
                    <i class="fa-solid fa-circle-check mr-2"></i>ÉXITO
                </p>
                <div class="flex items-center">
                    <p class="text-xs text-success-700">{{ now()->subSeconds()->diffForHumans() }} atrás</p>
                    <button type="button"class="ml-2 box-content rounded-none border-none opacity-80 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                        data-te-toast-dismiss aria-label="Close">
                        <span class="text-xs w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
                            <i class="fa-solid fa-x"></i>
                        </span>
                    </button>
                </div>
            </div>

            <div class="break-words rounded-b-lg bg-success-100 px-4 py-4 text-success-700">
                {{ session('message') }}
            </div>
        </div>
    @else
        <div class="fixed top-24 right-8 z-50 pointer-events-auto mx-auto mb-4 hidden w-96 max-w-full rounded-lg bg-danger-100 bg-clip-padding text-sm text-danger-700 shadow-lg shadow-black/5 data-[te-toast-show]:block data-[te-toast-hide]:hidden"
            id="static-example" role="alert" aria-live="assertive" aria-atomic="true" data-te-autohide="false"
            data-te-toast-init data-te-toast-show>
            <div class="flex items-center justify-between rounded-t-lg border-b-2 border-danger-200 bg-danger-100 bg-clip-padding px-4 pb-2 pt-2.5 text-danger-700">
                <p class="flex items-center font-bold text-danger-700">
                    <i class="fa-solid fa-circle-check mr-2"></i>ERROR
                </p>
                <div class="flex items-center">
                    <p class="text-xs text-danger-700">{{ now()->subSeconds()->diffForHumans() }} atrás</p>
                    <button type="button" class="ml-2 box-content rounded-none border-none opacity-80 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                        data-te-toast-dismiss aria-label="Close">
                        <span  class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
                            <i class="fa-solid fa-x"></i>
                        </span>
                    </button>
                </div>
            </div>
            <div class="break-words rounded-b-lg bg-danger-100 px-4 py-4 text-danger-700">
                {{ session('message') }}
            </div>
        </div>
    @endif
@endif




<!-- Footer container -->
<footer
    class="px-0 md:px-20 bg-neutral-800 text-center text-neutral-300 dark:bg-neutral-600 dark:text-neutral-200 lg:text-left">
    <div class="flex items-center justify-center p-4 border-b border-b-gray-400 lg:justify-between">
        <div class="mr-12 hidden lg:block">
            <span>Mantente conectado con nuestras redes sociales:</span>
        </div>
        <!-- Social network icons container -->
        <div class="flex justify-center">
            <a href="#!" class="mr-6 text-neutral-300 dark:text-neutral-200">
                <i class="fa-brands fa-facebook !text-neutral-300"></i>
            </a>
            <a href="#!" class="mr-6 text-neutral-300 dark:text-neutral-200">
                <i class="fa-brands fa-twitter !text-neutral-300"></i>
            </a>
            <a href="#!" class="mr-6 text-neutral-300 dark:text-neutral-200">
                <i class="fa-brands fa-instagram !text-neutral-300"></i>
            </a>
            <a href="#!" class="text-neutral-300 dark:text-neutral-200">
                <i class="fa-solid fa-envelope !text-neutral-300"></i>
            </a>
        </div>
    </div>

    <div class="mx-6 py-10 text-center md:text-left">
        <div class="grid-1 grid gap-8 md:grid-cols-4">
            <!-- Tailwind Elements section -->
            <div class="w-fit col-span-2">
                <h6 class="mb-4 flex items-center justify-center font-semibold uppercase md:justify-start">
                    <i class="fa-solid fa-building-columns mr-3"></i>
                    Municipalidad de Puerto Montt
                </h6>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae ultricies felis, a bibendum
                    nibh. Nulla pretium eget mauris ac hendrerit.
                </p>
            </div>
            <!-- Useful links section -->
            <div class="">
                <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                    Enlaces útiles
                </h6>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-300 dark:text-neutral-200">Puerto Montt</a>
                </p>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-300 dark:text-neutral-200">DIDECO</a>
                </p>
                <p class="mb-4">
                    <a href="#!" class="text-neutral-300 dark:text-neutral-200">SUBDEL</a>
                </p>
                <p>
                    <a href="#!" class="text-neutral-300 dark:text-neutral-200">Contacto</a>
                </p>
            </div>
            <!-- Contact section -->
            <div>
                <h6 class="mb-4 flex justify-center font-semibold uppercase md:justify-start">
                    Contacto
                </h6>
                <p class="mb-4 flex items-center justify-center md:justify-start">
                    <i class="fa-solid fa-house mr-2"></i>
                    Av. Presidente Ibañez #600
                </p>
                <p class="mb-4 flex items-center justify-center md:justify-start">
                    <i class="fa-solid fa-envelope mr-2 !text-neutral-300"></i>
                    info@example.com
                </p>
                <p class="mb-4 flex items-center justify-center md:justify-start">
                    <i class="fa-solid fa-phone mr-2"></i>
                    + 65 2 261315
                </p>
            </div>
        </div>
    </div>
</footer>
<!--Copyright section-->
<div class="bg-neutral-700 p-6 text-center text-neutral-300 dark:bg-neutral-700">
    <span>© 2023 Copyright:</span>
    <a class="font-semibold text-neutral-300 dark:text-neutral-400" href="https://tailwind-elements.com/">
        Gustavo Quilodrán | gaqs.02@gmail.com
    </a>
</div>
