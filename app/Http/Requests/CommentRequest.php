<?php
/**
 * Created by PhpStorm.
 * User: hanongda
 * Date: 18-4-10
 * Time: 下午12:07
 */

namespace App\Http\Requests;


class CommentRequest extends Request
{
    public function rules()
    {
        return [
            'comment' => 'required|min:2',
        ];
    }
}