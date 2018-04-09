<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $comment = $request->get('comment');
        if (empty($comment)){
            return redirect()->back()->withErrors('评论内容不能为空');
        }

        Auth::user()->comments()->create([
            'comment' => $request['comment'],

        ]);

        return redirect()->back();
    }
}
