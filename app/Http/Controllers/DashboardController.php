<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function index()
    {
        $blogs = Blogs::paginate(10, [
            'id',
            'title',
            'description',
            'updated_at',
        ]);
        // dd($blogs);
        // session()->put('trash','Trash');
        return view('dashboard')->with('blogs', $blogs)->with('trash', 'Trash');
    }

    public function delete()
    {
        $id = request()->input('courseIDs');
        Blogs::whereIn('id',$id)->delete();
        return redirect()->route('dashboard.home')->with('success', 'Blog deleted successfully');
    }

    public function restore($id=null)
    {
        if (request()->has('all')){
            return $this->restoreAll();
        }else{
            $blogs = Blogs::onlyTrashed()->find($id);
            $blogs->restore();
            return redirect()->route('dashboard.home')->with('success', 'Blog restored successfully');
        }
    }

    public function trash()
    {
        $blogs = Blogs::onlyTrashed()->paginate(10, [
            'id',
            'title',
            'description',
            'updated_at',
        ]);
        // dd($blogs);
        return view('dashboard')->with('blogs', $blogs);
    }

    public function restoreAll()
    {
        $id = request()->input('courseIDs');
        Blogs::onlyTrashed()->whereIn('id',$id)->restore();
        return redirect()->route('dashboard.home')->with('success', 'Blog restored successfully');
    }
}
