@extends('layouts.app')

@section('title') Update @endsection


@section('content')
    <h1>Update Post</h1>

    <form method="POST" action="{{route('posts.index')}}">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="posted_by">Posted By</label>
            <input type="text" name="posted_by" id="posted_by" class="form-control" required>
        </div>
        <x-button type="primary">Update</x-button>

        <!-- <button type="submit" class="btn btn-primary">Update</button> -->
    </form>
@endsection
