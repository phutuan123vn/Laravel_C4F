@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h3>Edit Blog</h3>
    <form action="/blog/edit/{{$blog->slug}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$blog->title}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{$blog->description}}</textarea>
        </div>
        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <input type="text" class="form-control" id="level" name="level" value="{{$blog->level}}">
        </div>
        <div class="mb-3">
            <label for="videoID" class="form-label">Video ID</label>
            <input type="text" class="form-control" id="videoID" name="videoID" value="{{$blog->videoID}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
</div>
@endsection