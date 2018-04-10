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

        if (empty($comment)){
            return redirect()->back()->withErrors('评论内容不能为空');
        }

        return redirect()->to($comment->status->link())->with('success','创建成功!');
    }
}
