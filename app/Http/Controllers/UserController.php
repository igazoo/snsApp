<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Follower;
use App\User;

class UserController extends Controller
{
    //
    public function index()
    {
       $users = User::all();
       return view('user.index',compact('users'));
    }

    public function follow(User $user)
    {
      $follower = auth()->user();
      //フォローしているか
      $is_following = $follower->isFollowing($user->id);

      if(!$is_following){
        //フォローしていなければフォローする
        $follower->follow($user->id);
        return back();
      }
    }
      // フォロー解除
     public function unfollow(User $user)
     {
         $follower = auth()->user();
         // フォローしているか
         $is_following = $follower->isFollowing($user->id);
         if($is_following) {
             // フォローしていればフォローを解除する
             $follower->unfollow($user->id);
             return back();
         }
     }
}
