@props([
    'id' => 'modal',
    'title' => 'Modal',
    'size' => 'lg', // valores posibles: "lg" | "fullscreen"
])

<div data-te-modal-init 
     class="fixed left-0 top-0 hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none z-[9999]" 
     id="{{ $id }}" 
     tabindex="-1" 
     aria-labelledby="{{ $id }}Label" 
     aria-modal="true" 
     role="dialog">

    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out 

         @if($size === 'fullscreen') mt-0 h-full w-full @else mt-7 mx-auto max-w-4xl @endif">

        <div class="pointer-events-auto relative flex flex-col 

            @if($size === 'fullscreen') w-full h-full @else w-full @endif

            rounded-md border-none bg-slate-50/80 bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">

            <!-- Botón cerrar (superior derecha) -->
            <button type="button" class="absolute right-0 m-2.5 z-50 box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal body -->
            <div class="relative p-4 min-h-[300px]">
                {{ $slot }}

                <!-- Botón cerrar inferior derecha -->
                <button type="button" class="fixed bottom-8 right-8 z-50 inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400" data-te-modal-dismiss>
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
