<div>
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                    Comentarios ({{$comments->total()}})
                </h5>
            </div>
            @auth
                @include('commentify::livewire.partials.comment-form',[
                    'method'=>'postComment',
                    'state'=>'newCommentState',
                    'inputId'=> 'comment',
                    'inputLabel'=> 'Tu comentario',
                    'button'=>'Comentar'
                ])
            @else
                <div class="py-5 text-center">
                    <a class="text-lg mt-2 text-danger" href="/login">Inicia sesión para dar tu opinión!</a>
                </div>
            @endauth
            @php( $count = 0 )
            @if($comments->count())
                @foreach($comments as $comment)
                    <livewire:comment :comment="$comment" :key="$comment->id"/>
                    <div class="px-6">
                        @if ( $count != ($comments->count() - 1) )
                            <hr>
                            @php( $count ++ )
                        @endif
                    </div>
                @endforeach
                {{$comments->links()}}
            @else
                <p>No hay opiniones! :(</p>
            @endif
        </div>
    </section>
</div>
