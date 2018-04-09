<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment'];

    /**
     * 一条评论属于一个用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 一条评论属于一条动态
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Status()
    {
        return $this->belongsTo(Status::class);
    }
}
