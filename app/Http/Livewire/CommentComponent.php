<?php

namespace App\Http\Livewire;
use App\Models\Comment;

use Livewire\Component;

class CommentComponent extends Component
{
    public function render()
    {
        return view('livewire.comment-component');
    }
    public $comments;
    public $newComment;

    public function mount()
    {
        $this->comments = Comment::all();
        $this->newComment = '';
    }

    public function saveComment()
    {
        $comment = new Comment;
        $comment->body = $this->newComment;
        $comment->save();

        $this->comments = Comment::all();
        $this->newComment = '';
    }
}
