<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;


class Comments extends Component
{
    public $post;

    public function render()
    {
        return view('livewire.comments', [
        'comments' => $this->post->comments()->latest()->get(),
        ]);
    }
}
