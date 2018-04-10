<?php

namespace App\Observers;

use App\Models\Comment;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class CommentObserver
{
    public function created(Comment $comment)
    {
        $comment->status->increment('comment_count', 1);
    }

    public function creating(Comment $comment)
    {
        //使用 HTMLPurifier 来修复 XSS 安全问题
        //$comment->comment = clean($comment->comment);
    }

    public function updating(Comment $comment)
    {
        //
    }
}