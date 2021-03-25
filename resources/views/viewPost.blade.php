@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h1>{{$post->post_title}}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<img src="{{asset('storage/images/'.$post->post_img)}}" class="img-fluid">
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-12">
			<p>{{$post->post_content}}</p>
		</div>
	</div>
	@auth
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('comments.store')}}" method="POST">
				@csrf
				<input type="hidden" name="post_id" value="{{$post->id}}">
			  <div class="form-group">
			    <label for="comment">Title:</label>
			    <textarea class="form-control" placeholder="Enter Your comments here..." id="comment" name="post_comment"></textarea>
			    @error('post_comment')
                    <span class="invalid-feedback" role="alert" style="display: block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
	@else
    <div class="row">
    	<a href="{{url('/')}}"><input type="button" value="Login to Commet"></a>
    </div>
    @endauth
	<div class="row">
	  	<div class="col-md-12"> 
	  	@if($post->comments)
	  	@foreach($post->comments as $comment)
	    <div class="card mt-4" style="background: grey">
	      <div class="row ">
	          <div class="col-md-12 px-3">
	            <div class="card-block px-3">
	              <p class="card-text">{{$comment->comments}}</p>
	              <p class="float-right">Posted By, {{$comment->user->name}}</p>
	            </div>
	          </div>
	        </div>
	      </div>
	      @endforeach
	      @endif
	  	</div>
    </div>
</div>
@endsection