<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    //
    public function store(Request $request)
    {
      $comment = new Comment;
      $comment->post_id = $request->input('post_id');
      $comment->text = $request->input('text');
      $comment->user_id = Auth::id();

      $comment->save();
      return redirect()->back();
    }
}
