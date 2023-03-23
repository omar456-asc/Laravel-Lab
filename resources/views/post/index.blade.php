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
            <th scope="col">Slug</th>
            <th scope="col">Description</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
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
                    @if(!$post->trashed())
                    <td>
                    <form action="{{ route('posts.view', $post->id) }}" method="GET">
                    @csrf
                    @method('GET')        
                    <button class="btn btn-primary view-post" data-id="{{ $post->id }}">View Ajax</button>
                    </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
            
    </table>
    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Post Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Title: <span id="postTitle"></span></p>
                <p>Description: <span id="postDescription"></span></p>
                <p>Username: <span id="postUsername"></span></p>
                <p>User Email: <span id="postUseremail"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <div class="d-flex justify-content-center">
    {{ $posts->links('vendor.pagination.pagination') }}
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    $('.view-post').click(function() {
        event.preventDefault();
        var postId = $(this).data('id');
        $.ajax({
            url: '/posts/' + postId + '/view',
            type: 'GET',
            success: function(response) {
                $('#postTitle').text(response.title);
                $('#postDescription').text(response.description);
                $('#postUsername').text(response.username);
                $('#postUseremail').text(response.useremail);
                $('#postModal').modal('show');
            }
        });
    });
});
</script>

@endsection


















