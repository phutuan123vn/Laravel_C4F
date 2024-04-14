<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blogs::paginate(9);
        // dd($blogs);
        return view('blog.home', ['blogs' => $blogs]);
    }

    public function create()
    {
        // dd(Auth::user());
        return view('blog.create');
    }

    public function store(StoreBlogRequest $request)
    {
        if($request->validated()){
            $data = $request->request->all();
            if (request()->method() == 'POST') {
                $blog = new Blogs();
                $blog->title = $data['title'];
                $blog->level = $data['level'];
                $blog->description = $data['description'];
                $blog->videoID = $data['videoID'];
                $blog->save();
            }else {
                Blogs::where('slug', $data['slug'])->update([
                    'title' => $data['title'],
                    'level' => $data['level'],
                    'description' => $data['description'],
                    'videoID' => $data['videoID']
                ]);
            }
            return redirect('/blog', 302)->with('success', 'Blog created successfully');
        };
    }

    public function show($slug)
    {
        $blog = Blogs::where('slug', $slug)->first();
        if ((request()->has('edit'))) {
            return view('blog.edit', ['blog' => $blog]);
        }
        return view('blog.show', ['blog' => $blog]);
        
    }

    public function update(StoreBlogRequest $request, $slug)
    {
        if($request->validated()){
            $data = $request->request->all();
            $blog = Blogs::where('slug', $slug)->first();
            $blog->title = $data['title'];
            $blog->level = $data['level'];
            $blog->description = $data['description'];
            $blog->videoID = $data['videoID'];
            $blog->save();
            return redirect('/blog', 302);
        };
    }

    public function delete($id)
    {

        $path = parse_url(url()->previous())['path'];
        $blog = Blogs::find($id);
        $blog->delete();
        if (Auth::user()->role_id == 0 && $path == '/dashboard') {
            return redirect()->back()->with('success', 'Blog deleted successfully');
        }
        return redirect('/blog', 302)->with('success', 'Blog deleted successfully');
    }

    public function me()
    {
        $blogs = Blogs::where('user_id', Auth::user()->id)->paginate(9);
        return view('blog.home', ['blogs' => $blogs]);
    }
}
