@extends('layouts.app')

@section('content')
@foreach($users as $user)
@if(Auth::id() != $user->id )
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">{{$user->name}}
      </div>
      <div class="card-body text-center">
        @if (Auth::user()->isFollowed($user->id))
        <div class="px-2">
          <span class="px-1 bg-secondary text-light">フォローされています</span>
        </div>
        @endif
        <div class="d-flex justify-content-end flex-grow-1">
          @if (Auth::user()->isFollowing($user->id))
          <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger">フォロー解除</button>
          </form>
          @else
          <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
            {{ csrf_field() }}

            <button type="submit" class="btn btn-primary">フォローする</button>
          </form>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
  @endif
  @endforeach
  @endsection
