<x-admin-layout>
    @livewireScripts
    <div class="mx-auto">
        <div class="container-xl md:container mx-auto mb-2 md:ms-0 ms-4">
            <a href="{{ route('admin_business.create') }}">
                <x-button id="add_business" value="success" class="mb-3">Agregar negocio</x-button>
            </a>
        </div>

        <livewire:admin.business-table theme="tailwind" class="mt-10"/>
    </div>
</x-admin-layout>
