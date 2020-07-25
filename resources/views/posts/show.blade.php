@extends('layouts.app')

@section('content')
<img src='/storage/images/{{$post->image}}'width="300px" height="200px">
{{$post->content}}
コメント一覧
@foreach($post->comments as $comment)
@if($comment->user_id === $user->id)
{{$user->name}}
@endif
{{$comment->text}}
@endforeach
<form class="" action="{{route('comments.store')}}" method="post">
  @csrf
    <input name="post_id" type="hidden" value="{{ $post->id }}">

    <div class="form-group">
      <label for="body">コメント</label>
      <textarea  name="text"  ></textarea>
    </div>
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            コメントする
        </button>
    </div>

</form>
@endsection
