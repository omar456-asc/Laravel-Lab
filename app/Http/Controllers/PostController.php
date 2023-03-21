<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::withTrashed()->paginate(5);
        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('post.show', compact('post'));
    }

    public function create()
    {
        $users = User::all();
        return view('post.create', compact('users'));
    }

    public function store(Request $request)
    {
        $title = $request->title;
        //dd($title);
        $description = $request->description;
        $postCreator = $request->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return redirect()->route('posts.index')
                         ->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        return view('post.edit', ['post'=>$post, 'users'=>$users]);
    }


    public function update(Post $post,Request $request)
  {
    $post->update($request->all());

    return redirect()->route("posts.index");
  }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully.');
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        $post->restore();
        return redirect()->back();
    }  
}
