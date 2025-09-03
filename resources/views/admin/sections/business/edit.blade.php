<x-admin-layout>
    <div class="container-xl md:container mx-auto mb-4">
        <a href="{{ route('admin_business.index') }}">
            <x-button value="primary"><i class="fas fa-long-arrow-alt-left"></i> Volver</x-button>
        </a>
    </div>

    @if( request()->routeIs('admin_business.create') )
    <form id="form" action="{{ route('admin_business.store') }}" method="POST" enctype="multipart/form-data">
    @else
    <form id="form" action="{{ route('admin_business.update', ['business' => $business->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @endif

        @csrf
        @include('admin.sections.business.form')

    </form>
    
    <script src="{{ asset('js/scripts.js') }}"></script>>
</x-admin-layout>

