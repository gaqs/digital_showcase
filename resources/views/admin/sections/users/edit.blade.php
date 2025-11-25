<x-admin-layout>
    <div class="container-xl md:container mx-auto mb-4">
        <a href="{{ route('admin_users.index') }}">
            <x-button value="primary"><i class="fas fa-long-arrow-alt-left"></i> Volver</x-button>
        </a>
    </div>
    <form id="form" action="{{ route('admin_users.update', $user->id ) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.sections.users.form')

    </form>
    <script src="{{ asset('js/scripts.js') }}"></script>
</x-admin-layout>
