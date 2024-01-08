<div>
    @if($isEditing)
        @include('commentify::livewire.partials.comment-form',[
            'method'=>'editComment',
            'state'=>'editState',
            'inputId'=> 'reply-comment',
            'inputLabel'=> 'Tu respuesta',
            'button'=>'Editar comentario'
        ])
    @else
        <article id="comment_id_{{ $comment->id }}" class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
            <footer class="flex justify-between items-center mb-1">

                @php
                    $avatar = ($comment->user->avatar == null) ? 'uploads/users/default_avatar.jpg' : 'uploads/users/'.$comment->user->id.'/'.$comment->user->avatar;
                @endphp

                <div class="flex items-center">
                    <div class="flex flex-row content-center">
                        <div class="mr-3" id="user_avatar">
                            <img src="{{ asset( $avatar) }}" alt="{{$comment->user->name}}" class="w-12 rounded-full" alt="Avatar" />
                        </div>
                        <div>
                            <p class="font-bold" id="user_name">{{Str::ucfirst($comment->user->name)}}</p>
                            <div>
                                <div id="stars" class="inline">
                                    <?= print_stars($comment->score) ?>
                                </div>
                                <p class="text-sm text-gray-500 inline">
                                    <time pubdate datetime="{{$comment->presenter()->relativeCreatedAt()}}" title="{{$comment->presenter()->relativeCreatedAt()}}">
                                        {{$comment->presenter()->relativeCreatedAt()}}
                                    </time>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <button wire:click="$toggle('showOptions')" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <!-- Dropdown menu -->
                    @if($showOptions)
                        <div class="absolute z-10 top-full right-0 mt-1 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                @can('update',$comment)
                                    <li>
                                        <button wire:click="$toggle('isEditing')" type="button" class="block w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Editar
                                        </button>
                                    </li>
                                @endcan
                                @can('destroy',$comment)
                                    <li>
                                        <button
                                            x-on:click="confirmCommentDeletion"
                                            x-data="{
                                                confirmCommentDeletion(){
                                                    if(window.confirm('You sure to delete this comment?')){
                                                        @this.call('deleteComment')
                                                    }
                                                }
                                            }"
                                            class="block w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            Borrar
                                        </button>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    @endif
                </div>


            </footer>
            <p class="text-gray-500 dark:text-gray-400">
                {!! $comment->presenter()->replaceUserMentions($comment->presenter()->markdownBody()) !!} <!--$comment->body-->
            </p>

            <div class="flex items-center mt-4 space-x-4">
                <livewire:like :comment="$comment" :key="$comment->id"/>
                @auth
                    @if($comment->isParent())
                        <button type="button" wire:click="$toggle('isReplying')" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                            <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Responder
                        </button>
                        <div wire:loading wire:target="$toggle('isReplying')">
                            @include('commentify::livewire.partials.loader')
                        </div>
                    @endif
                @endauth
                @if($comment->children->count())
                    <button type="button" wire:click="$toggle('hasReplies')"
                            class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400">
                        @if(!$hasReplies)
                            Ver todas las respuestas ({{$comment->children->count()}})
                        @else
                            Esconder respuestas
                        @endif
                    </button>
                    <div wire:loading wire:target="$toggle('hasReplies')">
                        @include('commentify::livewire.partials.loader')
                    </div>
                @endif

            </div>

        </article>
    @endif
    @if($isReplying)
        @include('commentify::livewire.partials.comment-form',[
           'method'=>'postReply',
           'state'=>'replyState',
           'inputId'=> 'reply-comment',
           'inputLabel'=> 'Tu respuesta',
           'button'=>'Responder'
       ])
    @endif
    @if($hasReplies)

        <article class="p-1 mb-1 ml-1 lg:ml-12 border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            @foreach($comment->children as $child)
                <livewire:comment :comment="$child" :key="$child->id"/>
            @endforeach
        </article>
    @endif
    <script>
        function detectAtSymbol() {
            const textarea = document.getElementById('reply-comment');

            // Check if the textarea element exists
            if (!textarea) {
                console.warn("Couldn't find the 'reply-comment' element.");
                return;
            }

            const cursorPosition = textarea.selectionStart;
            const textBeforeCursor = textarea.value.substring(0, cursorPosition);
            const atSymbolPosition = textBeforeCursor.lastIndexOf('@');

            if (atSymbolPosition !== -1) {
                const searchTerm = textBeforeCursor.substring(atSymbolPosition + 1);

                if (searchTerm.trim().length > 0) {
                    window.livewire.emit('getUsers', searchTerm);
                }
            }
        }
    </script>

</div>


