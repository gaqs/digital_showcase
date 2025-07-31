<x-admin-layout>
    <div class="container mx-auto mb-4">
        <a href="{{ route('admin_product.index') }}">
            <x-button value="primary"><i class="fas fa-long-arrow-alt-left"></i> Volver</x-button>
        </a>
    </div>
    <form id="form" action="{{ route('admin_product.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.sections.products.form')

    </form>
    <script src="{{ asset('js/scripts.js') }}"></script>
</x-admin-layout>
