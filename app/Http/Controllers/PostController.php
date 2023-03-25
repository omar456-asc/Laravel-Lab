<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Jobs\PruneOldPostsJob;

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

    
    public function store(StorePostRequest $request)
  {
        $tags = explode(",", $request->tags);
        $image = $request->file('image')->store('images',['disk' => "public"]);
        $data = $request->validated();
        $data["image"] = $image;
        $data["tags"] = $tags;
        $post =Post::create($data);
        $post->syncTags($tags);

    return redirect()->route("posts.index");
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
    public function view($id)
    {
        $post = Post::find($id);
        return response()->json([
            'title' => $post->title,
            'description' => $post->description,
            'username' => $post->user->name,
            'useremail' => $post->user->email,
        ]);
    }
    public function removePosts()
    {
      PruneOldPostsJob::dispatch();
    }
}
