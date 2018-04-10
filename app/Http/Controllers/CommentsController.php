<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CommentRequest $request, Comment $comment)
    {
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->status_id = $request->status_id;
        $comment->save();


        return redirect()->back()->with('success','创建成功!');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('destroy', $comment);
        $comment->delete();

        return redirect()->back()->with('success', '删除成功！');
    }
}
