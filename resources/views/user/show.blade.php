@extends('layouts.app')

@section('content')
{{$user->name}}
@foreach($posts as $post)
@if($user->id === $post->user_id)
<img src='/storage/images/{{$post->image}}'height="300px" width="350px" >

@endif
@endforeach
@endsection
