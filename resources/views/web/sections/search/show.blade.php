<x-app-layout>
    <div class="container-xl relative md:px-20 py-20">
        @if ($search_type == 'business')
            @include('web.sections.search.partials.business')
        @elseif ( $search_type == 'product')
            @include('web.sections.search.partials.products')
        @endif
    </div>
</x-app-layout>

