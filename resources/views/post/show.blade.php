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
            <img src="{{Storage::url($post->image)}}" style="width: 250px" alt="No Image Uploaded">
            <p class="mt-2">
                Tags: @foreach($post->tags as $tag) <span class="badge rounded-pill text-bg-warning">{{$tag->name}}</span> @endforeach
            </p>
        </div>
    </div>

    <div class="card mt-6">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Author: {{ optional($post->user)->name ?? 'Not Found' }}</h5>
            <p class="card-text">Email: {{optional($post->user)->email ?? 'Not Found'}}</p>            
      <p class="card-text text-muted mt-2 fs-6">{{$post->human_readable_date}}</p>
        </div>
    </div>
    <div>
<livewire:add-comment :post="$post" />

<livewire:comments :post="$post" />
@endsection