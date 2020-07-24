<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    //
    public function likes()
    {
      return $this->hasMany('App\Models\Like', 'post_id');//外部キーとしてpost_idを使用
    }

    public function is_liked_by_auth_user()
    {
      $id = Auth::id();
      $likers = [];

      foreach($this->likes as $like){
        array_push($likers , $like->user_id);
      }

      if(in_array($id , $likers)){
        return true;
      }else{
        return false;
      }
    }
}
