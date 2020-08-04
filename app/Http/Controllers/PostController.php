<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Services\SaveImagesServices;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class PostController extends Controller
{
    //only()の引数内のメソッドはログイン時のみ有効
    public function __construct(){
      $this->middleware(['auth' , 'verified'])->only(['like' ,'unlike']);
    }

    /**
      * 引数のIDに紐づくリプライにLIKEする
      *
      * @param $id リプライID
      * @return \Illuminate\Http\RedirectResponse
      */
      //いいねメソッド
      public function like($id)
      {
          Like::create([
            'post_id' =>$id,
            'user_id' =>Auth::id()
          ]);
          session()->flash('いいね');
          return redirect()->back();
      }
      //いいね解除メソッド

      public function unlike($id)
      {
        $like = Like::where('post_id',$id)->where('user_id',Auth::id())
        ->first();
        $like->delete();

        session()->flash('いいねを外しました');
        return redirect()->back();

      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $posts = Post::orderBy('created_at','desc')->get();;

        return view('posts.index',compact('posts' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $post = new Post;
        //get filename
        $filename = $request->file('image')->store('public/images');

        $post->image = basename($filename);

        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->save();

        return redirect('posts/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);
        $user = Auth::user();


        return view('posts.show',compact('post','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $post = Post::find($id);

        $post->content = $request->input('content');
        $post->save();

        return redirect('posts/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();
        return redirect('posts/index');
    }
}
