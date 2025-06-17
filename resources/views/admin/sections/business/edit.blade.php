<x-admin-layout>
    <div class="container mx-auto mb-4">
        <a href="{{ route('admin_business.index') }}">
            <x-button value="primary"><i class="fas fa-long-arrow-alt-left"></i> Volver</x-button>
        </a>
    </div>
    <form id="form" action="{{ route('admin_business.update', ['business' => $business->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.sections.business.form')

    </form>
    <script src="{{ asset('js/scripts.js') }}"></script>>
</x-admin-layout>

