<x-app-layout>
    @include('web.sections.static.partials.carousel')
    <div class="container-xl relative relative z-10 -mt-10">
        <div class="flex justify-center">
            <div class="basis-full md:basis-4/6">
                @include('web.sections.static.partials.search')
            </div>
        </div>
    </div>
    @include('web.sections.static.partials.business')
    @include('web.sections.static.partials.products')
    <!-- Oficios -->
    @include('web.sections.static.partials.trades')
    <!-- /Oficios -->
    @include('web.sections.static.partials.comments')
    @include('web.sections.static.partials.aboutus')
</x-app-layout>
