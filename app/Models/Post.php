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

    public function comments()
    {
      return $this->hasMany('App\Models\Comment', 'post_id');
    }

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function is_liked_by_auth_user()//ログインユーザーがいいねしているかの判定メソッド
    {
      $id = Auth::id();//ログインユーザー
      $likers = [];

      foreach($this->likes as $like){
        array_push($likers , $like->user_id);//紐づいているユーザーIDを配列にいれる
      }

      if(in_array($id , $likers)){//もし配列にログインユーザーIDがあれは真なければ偽
        return true;
      }else{
        return false;
      }
    }
}
