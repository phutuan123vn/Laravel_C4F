@extends('layouts.app')
@section('content')
<div class="mt-4 d-flex justify-content-center">
    <div class="container  border  rounded-3 ">
        <form method="POST" action="/blog/store">
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input class="form-control"  name="title" required>
                @error('title')  
                    <span class="invalid-feedback" role="alert">  
                        <strong>{{ $message }}</strong>  
                    </span>  
                @enderror  
            </div>
    
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <input class="form-control"  name="description">
            </div>
    
            <div class="form-group">
                <label for="videoID" class="form-label">VideoID</label>
                <input class="form-control" name="videoID">
            </div>
    
            <div class="form-group">
                <label for="level" class="form-label">Trình độ</label>
                <input type="text" class="form-control"  name="level">
            </div>
    
            <button type="submit" class="mt-5 btn btn-primary w-25">Submit</button>
        </form>
    </div>
</div>
@endsection