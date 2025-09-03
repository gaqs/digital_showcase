<x-admin-layout>
    <div class="container mx-auto mb-4">
        <a href="{{ route('admin_trade.index') }}">
            <x-button value="primary"><i class="fas fa-long-arrow-alt-left"></i> Volver</x-button>
        </a>
    </div>

    <form id="form" action="{{ route('admin_trade.update', ['trade' => $trade->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('admin.sections.trades.form')

    </form>


    <script src="{{ asset('js/scripts.js') }}"></script>>
</x-admin-layout>