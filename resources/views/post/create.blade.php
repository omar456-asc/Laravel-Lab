@extends('layouts.app')

@section('title') Create @endsection


@section('content')
    <h1>Create Post</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input name="title" type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="image" >
    </div>
    <div class="mb-3">
      <label for="tags" class="form-label">Tags</label>
      <input type="test" class="form-control" name="tags" id="tags">
    </div>

        <div class="form-group">
            <label for="posted_by">Posted By</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <x-button type="danger">Create</x-button>
        <!-- <button type="submit" class="mt-4 btn btn-success">Create</button> -->
    </form>
@endsection
