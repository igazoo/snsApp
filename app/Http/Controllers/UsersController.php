<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Follower;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class UsersController extends Controller
{
  //
  public function index()
  {
    $users = User::all();
    return view('user.index',compact('users'));
  }

  public function show($id)
  {
      $user = User::find($id);
      $posts = Post::all();


      return view('user.show',compact('user' , 'posts'));
  }

  // フォロー
  public function follow($id)
  {
    $user = User::find($id);
    $follower = Auth::user();
    // フォローしているか
    $is_following = $follower->isFollowing($user->id);
    if(!$is_following) {
      // フォローしていなければフォローする
      $follower->follow($user->id);
      return back();
    }
  }

  // フォロー解除
  public function unfollow($id)
  {
    $user = User::find($id);
    $follower = Auth::user();
    // フォローしているか
    $is_following = $follower->isFollowing($user->id);
    if($is_following) {
      // フォローしていればフォローを解除する
      $follower->unfollow($user->id);
      return back();
    }
  }
}
