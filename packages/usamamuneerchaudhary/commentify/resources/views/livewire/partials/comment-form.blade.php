<div class="px-6">
    @if (session()->has('comment_message') )
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 99000)">
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Correcto!</span> {{session('comment_message')}}
        </div>
        </div>
    @endif

    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 99000)">
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">Error!</span>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    @endif
</div>


<form id="comment-form" class="mb-6 px-6 flex flex-col" wire:submit.prevent="{{$method}}" autocomplete="off">
    @csrf

    @if( $method != 'postReply' )
        <div class="mb-2">
            <div class="star_wrapper">
                <input type="radio" id="{{$state}}.r5" value="5" wire:model.defer="{{$state}}.score">
                <label for="{{$state}}.r5"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="{{$state}}.r4" value="4" wire:model.defer="{{$state}}.score">
                <label for="{{$state}}.r4"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="{{$state}}.r3" value="3" wire:model.defer="{{$state}}.score">
                <label for="{{$state}}.r3"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="{{$state}}.r2" value="2" wire:model.defer="{{$state}}.score">
                <label for="{{$state}}.r2"><i class="fa-solid fa-star"></i></label>
                <input type="radio" id="{{$state}}.r1" value="1" wire:model.defer="{{$state}}.score">
                <label for="{{$state}}.r1"><i class="fa-solid fa-star"></i></label>
            </div>
        </div>
    @endif

    <div>
        <label for="{{$inputId}}" class="sr-only">{{$inputLabel}}</label>
        <textarea id="{{$inputId}}" rows="6" class="block p-3 mb-2 w-full text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error($state.'.body') border-red-500 @enderror" placeholder="Escribe un comentario..." wire:model.defer="{{$state}}.body" oninput="detectAtSymbol()"
        ></textarea>

        @if(!empty($users) && $users->count() > 0)
            @include('commentify::livewire.partials.dropdowns.users')
        @endif
    </div>

    <div class="text-right">
        <x-button wire:loading.attr="disabled" value="danger" type="submit" >
            <div wire:loading wire:target="{{$method}}">
                @include('commentify::livewire.partials.loader')
            </div>
            {{$button}}
        </x-button>
        @if($method == 'editComment')
            <x-button value="secondary">Cancelar</x-buton>
        @endif
    </div>


</form>
