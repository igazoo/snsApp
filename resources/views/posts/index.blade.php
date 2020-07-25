@extends('layouts.app')

@section('content')
<div class="">
  @foreach($posts as $post)
  {{$user->name}}
  <img src='/storage/images/{{$post->image}}'width="300px" height="200px">
  {{$post->content}}

  <a href="{{route('posts.edit', ['id' => $post->id])}}">編集
    <form  action="{{route('posts.destroy',['id' => $post->id])}}" method="post" id ="delete_{{$post->id}}">
      @csrf
      <a href="#"  data-id ="{{$post->id}}" onclick="deletePost(this);">削除</a>
    </form>
    <div class="">
      @if($post->is_liked_by_auth_user())
      <a href="{{route('posts.unlike',['id' => $post->id])}}" class="btn btn-danger btn-sm">いいね<span class="badge">{{$post->likes->count()}}</span></a>
      @else
      <a href="{{route('posts.like',['id' => $post->id])}}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{$post->likes->count()}}</span></a>
      @endif
    </div>

    <a href="{{route('posts.show', ['id' =>$post->id])}}">コメント<span class="badge">{{$post->comments->count()}}</span></a>
    @endforeach
  </div>
  <script>
  <!--
  /*******
  削除ボタンを押して一旦jsで確認メッセージを出す
  *******/
  //-->>
  function deletePost(e){
    'user strict';
    if(confirm('本当に削除してもいいですか？')){
      document.getElementById('delete_' + e.dataset.id).submit();
    }
  }
</script>
@endsection
