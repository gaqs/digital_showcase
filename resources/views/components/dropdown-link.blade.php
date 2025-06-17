@props([
    'href' => '#'
])
<li>
    <a {{ $attributes->merge(['class' => 'block w-full whitespace-nowrap bg-transparent py-3 pl-4 pr-6 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-neutral-600']) }}
        href="{{ $href }}" data-te-dropdown-item-ref>{{ $slot }}</a>
</li>
