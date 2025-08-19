<?php

namespace Usamamuneerchaudhary\Commentify\Http\Livewire;


use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Comments extends Component
{
    use WithPagination;

    public $model;

    public $users = [];

    public $showDropdown = false;

    public $newCommentState = [
        'body' => '',
        'score' => ''
    ];

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    protected $validationAttributes = [
        'newCommentState.body' => 'comentario',
        'newCommentState.score' => 'puntaje'
    ];

    /**
     * @return Factory|Application|View|\Illuminate\Contracts\Foundation\Application|null
     */
    public function render(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application|null
    {
        $comments = $this->model
            ->comments()
            ->with('user', 'children.user', 'children.children')
            ->parent()
            ->latest()
            ->paginate(config('commentify.pagination_count', 10));

        return view('commentify::livewire.comments', [
            'comments' => $comments
        ]);
    }

    /**
     * @return void
     */
    public function postComment(): void
    {
        session()->forget('message');

        $this->validate([
            'newCommentState.body' => 'required',
            'newCommentState.score' => 'required'
        ]);

        $comment = $this->model->comments()->make($this->newCommentState);

        $comment->user()->associate(auth()->user());
        $comment->save();

        //actualizacion de cantidad y score de tabla business por cada comentario creado.
        $db = DB::table('comments')
                        ->select(DB::raw('count(*) as qty_comments, avg(score) as score'))
                        ->where('commentable_type', $comment->commentable_type)
                        ->where('commentable_id', $comment->commentable_id)
                        ->get();

        $table = 'business';

        if ($comment->commentable_type == 'App\Models\Product') {
            $table = 'product';
        } elseif ($comment->commentable_type == 'App\Models\TradeSkill') {
            $table = 'trade_skill';
        }

        $update = DB::table($table)
                        ->where('id', $comment->commentable_id)
                        ->update([
                            'score' => number_format(($db[0]->score + 5) / 2, 1, '.', ''),
                            'qty_comments' =>$db[0]->qty_comments
                        ]);

        $this->newCommentState = [
            'body' => '',
            'score' => ''
        ];

        $this->users = [];
        $this->showDropdown = false;

        $this->resetPage();
        session()->flash('comment_message', 'Comentario ingresado correctamente!');

    }

}
