<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;


class Comments extends Component
{
    public $post;
    public $comments;
    protected $listeners = ["commentAdded"=>'$refresh'];

    public function render()
    {
        $this->comments = $this->post->comments;
    return view('livewire.comments',["comments"=>$this->comments]);
    }
}
