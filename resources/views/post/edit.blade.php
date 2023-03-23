@extends('layouts.app')

@section('title') Update @endsection


@section('content')
    <h1>Update Post</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" name="title" id="title" class="form-control" required value="{{ old('title',$post->title) }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $post->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="posted_by">Posted By</label>
            <select name="posted_by" id="posted_by" class="form-control" required>
                @foreach($users as $user)
                <option value="{{$user->id}}" {{$post->user->id === $user->id ? "selected" : ""}}>{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <x-button type="primary">Update</x-button>

        <!-- <button type="submit" class="btn btn-primary">Update</button> -->
    </form>
@endsection
