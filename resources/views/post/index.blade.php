@extends('layouts.app')


@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
                <tr>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td>{{ optional($post->user)->name ?? 'Not Found' }}</td>
                    <td>{{$post->created_at->format('M d, Y')}}</td>
                    <td>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">Edit</a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection


















