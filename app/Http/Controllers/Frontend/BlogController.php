<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Blog::where('status', 'active')->paginate(5);
        return view('frontend.blog.index', compact('blogs'));
    }

    public function single($id){
        $blog = Blog::where('id', $id)->first();
        $comments = BlogComment::with('replies')->where('blog_id',$blog->id)->whereNull('parent_id')->get();
        return view('frontend.blog.single', compact('blog', 'comments'));
    }


}
