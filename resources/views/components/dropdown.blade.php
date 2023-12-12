@props([
    'type' => 'link',
    'value' => 'Dropdown'
])

@php
    $class = ($type == 'button') ? 'disabled:opacity-50 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-sm font-medium leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]' : 'text-sm font-semibold p-0 hover:text-rose-500 focus:text-rose-500 disabled:text-black/30 lg:px-2 [&.active]:text-rose/90 dark:[&.active]:text-neutral-400';
@endphp


<div class="relative" data-te-dropdown-ref>
    <a {{ $attributes->merge(['class' => $class ]) }} href="#" type="{{ $type }}" id="dropdown_menu" data-te-dropdown-toggle-ref aria-expanded="false" data-te-ripple-init data-te-ripple-color="light">
        {{ $value }}
        <span class="ml-1 w-2">
            <i class="fa-solid fa-angle-down"></i>
        </span>
    </a>
    <ul class="absolute z-[1000] float-left m-0 mt-3 hidden min-w-max list-none overflow-hidden rounded border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block" aria-labelledby="dropdown_menu" data-te-dropdown-menu-ref>

        {{ $slot }}

    </ul>
</div>
