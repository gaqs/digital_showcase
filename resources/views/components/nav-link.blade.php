@props([
    'active' => false,
    'href' => '#',
])

@php
    $class = ($active == false) ? "text-sm font-semibold p-0 hover:text-rose-500 focus:text-rose-500 disabled:text-black/30 lg:px-2 [&.active]:text-rose/90 dark:[&.active]:text-neutral-400" : "text-sm font-semibold p-0 text-rose-600 hover:text-rose-300 focus:text-rose-500 disabled:text-rose/30 lg:px-2 [&.active]:text-rose/90 dark:[&.active]:text-neutral-400";

@endphp

<li class="mb-4 lg:mb-0 lg:pr-2" data-te-nav-item-ref>
    <a {{ $attributes->merge(['class' => $class]) }} href="{{ $href }}" data-te-nav-link-ref>{{ $slot }}</a>
</li>
