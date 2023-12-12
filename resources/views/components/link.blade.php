@props([
    'href' => "#",
])

<a {{ $attributes->merge(["class" => "text-danger-500 transition duration-150 ease-in-out hover:text-danger-700 focus:text-danger-600 active:text-danger-700"]) }}  href={{ $href }}>
    {{ $slot }}
</a>
