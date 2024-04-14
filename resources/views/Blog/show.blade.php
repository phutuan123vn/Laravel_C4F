@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-3">
            <Button>Subcribe</Button>
            <h2>Độ Khó: {{$blog->level}}</h2>
        </div>

        <div class="col-lg">
            <h1>{{$blog->title}}</h1>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$blog->videoID}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p>{{$blog->description}}</p>
        </div>

        @if (Auth::user()->id == $blog->user_id)
            <div class="col col-sm d-flex flex-column align-items-center">
                <div>
                    <a href="/blog/{{ $blog->slug }}?edit=true" class="align-self-start btn btn-primary">{{ __('Edit Blog') }}</a>
                </div>
                <form action="/blog/{{ $blog->id }}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete Blog') }}</button>
                </form>
            </div>
            {{-- <div class="col col-sm d-inline-flex justify-content-center">
            </div>

            <div class="col col-sm d-inline-flex justify-content-center">
            </div> --}}
        @endif
    </div>
</div>
@endsection