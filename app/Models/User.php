<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'stu_id', 'klass', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 用户头像
     */
     public function gravatar($size = '100')
     {
         $hash = md5(strtolower(trim($this->attributes['email'])));
         return "http://www.gravatar.com/avatar/$hash?s=$size";
     }

    /**
     * 调用 邮件消息通知
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * 一个用户拥有多条动态
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    /**
     * 将当前用户发布的所有动态从数据库中取出，并根据时间倒序排序
     */
    public function feed()
    {
        return $this->statuses()
            ->orderBy('created_at', 'desc');
    }

}
