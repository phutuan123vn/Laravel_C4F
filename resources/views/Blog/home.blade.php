@extends('layouts.app')
@section('content')
<div class="container">
    @if (request()->path() === 'blog/me')
    <div>
        <h1>
            My Blog
        </h1>
    </div>
    @endif
    @isset($blogs)
    @if (count($blogs) > 0)
    <div class="row position-relative mx-5 align-items-center">
        @foreach ($blogs as $blog )
        <div class="col-sm-6 col-md-4 mt-5">
                <div class="card card-blog-item">
                    <a href="/blog/{{$blog->slug}}">
                        <img class="card-img-top" src="https://i.ytimg.com/vi/{{$blog->videoID}}/hqdefault.jpg" alt="{{$blog->title}}" class="img-fluid">
                    </a>
                    <div class="card-body">
                        <a href="/blog/{{$blog->slug}}">
                            <h5 class="card-title">{{$blog->title}}</h5>
                        </a>
                        <p class="card-text">{{$blog->description}}</p>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    @else
    <h1 class="text-center mt-5">No courses found <span><a href="/blog/create">Create Blog.</a></span></h1>
    @endif
    @endisset
</div>
<div class="d-flex justify-content-center mt-5">
    <div>{!! $blogs->onEachSide(1)->links() !!}</div>
</div>
@endsection