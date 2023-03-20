@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-6">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-6">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Author: {{ optional($post->user)->name ?? 'Not Found' }}</h5>
            <p class="card-text">Email: {{optional($post->user)->email ?? 'Not Found'}}</p>
            <p class="card-text">Created At {{$post->created_at->format('M d, Y')}}</p>
        </div>
    </div>
    <div>
    <h2>Add Comment</h2>
    <form method="POST" action="{{ route('comments.store')}}">
        @csrf
        <div class="form-group">
            <label for="body">Comment</label>
            <textarea name="body" id="body" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="user">User</label>
            <select name="user" id="user" class="form-control" required>
                
                    <option value="{{ $post->user->id }}">{{ $post->user->name }}</option>
                
            </select>
        </div>
        <input type="hidden" name="commentable_id" value="{{ $post->id }}">
        <input type="hidden" name="commentable_type" value="{{ get_class($post) }}">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

    <div>
    <h2>Comments</h2>
    @foreach ($post->comments as $comment)
        <div>
            <p>{{ $comment->comment }}</p>
            <p>Comment by {{ $post->user->name }}</p>
        </div>
    @endforeach
</div>


@endsection