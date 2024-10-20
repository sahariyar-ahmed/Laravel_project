<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    public function comment($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'comment' => ['required', 'string'],
        ]);

        BlogComment::create([
            'user_id' => Auth::user()->id,
            'blog_id' => $id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'created_at' => now(),
        ]);

        // Redirect back to the single blog post with success message
        return redirect()->route('frontend.blog.single', ['id' => $id])
                     ->with('comment_complete', 'Comment successfully added.');
    }
}
