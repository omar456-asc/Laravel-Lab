@extends('layouts.app')

@section('title') Delete Post @endsection

@section('content')
    <h1>Delete Post</h1>
    <p>Are you sure you want to delete this post?</p>
    <p><strong>Title:</strong> {{ $post->title }}</p>
    <p><strong>Description:</strong> {{ $post->description }}</p>
    <form method="POST" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
        @csrf
        @method('DELETE')
        <x-button type="danger">Yes, Delete</x-button>
        <!-- <button type="submit" class="btn btn-danger">Yes, Delete</button> -->
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
