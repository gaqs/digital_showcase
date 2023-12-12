<x-admin-layout>
    <form id="form" action="{{ route('admin_business.update', ['business' => $business->id]) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.business.form')
    </form>
    <script src="{{ asset('js/scripts.js') }}"></script>
</x-admin-layout>

