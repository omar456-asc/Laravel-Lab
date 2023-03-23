<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;


class AddComment extends Component
{
    public $post;

public $comment;

public function addComment()
{
    $this->validate([
        'comment' => 'required',
    ]);

    $this->post->comments()->create([
        'body' => $this->comment,
    ]);

    $this->comment = '';
}
}
