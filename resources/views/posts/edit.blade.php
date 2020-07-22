@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('編集') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('posts.update',['id' =>$post->id]) }}"enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label  class="col-md-4 col-form-label text-md-right">{{ __('内容') }}</label>

              <div class="col-md-6">
                <input  class="form-control " name="content" value="{{$post->content}}">
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('編集する') }}
                </button>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
