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
                            @if($post->trashed())
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">Edit</a>
                            <button type="submit" class="btn btn-info">Restore</button>
                            </form>
                            @else
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success">Edit</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
            
    </table>
    <div class="d-flex justify-content-center">
    {{ $posts->links('vendor.pagination.pagination') }}
    </div>

@endsection


















