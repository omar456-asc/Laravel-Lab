<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = Post::with('user')->paginate(10);
        
         PostResource::collection($posts);

    }

    public function show($id)
    {
        $post = Post::find($id);

        return new PostResource($post);

    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validate();
        $post = new Post();
        $post->title = $data['title'];
        $post->descreption = $data['descreption'];
        $post->user_id = Auth::id();
        $post->save();

        return new PostResource($post);

    }
}