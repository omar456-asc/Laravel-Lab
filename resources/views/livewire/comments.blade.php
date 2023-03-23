<div>
  <div class="card my-3">
    <div class="card-header">
      Comments
    </div>
    <div class="card-body">
      <div class="comment">
        @foreach($comments as $comment)
          <div class="comments">
            <p class="card-text">{{$comment["comment"]}}</p>
            <p> Comment by {{$post->user->name}}</p>
          </div>
          <hr>
        @endforeach
      </div>
    </div>
  </div>
</div>