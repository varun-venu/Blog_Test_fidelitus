@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
			  <div class="form-group">
			    <label for="post-title">Title:</label>
			    <input type="text" class="form-control" placeholder="Enter Post Title" id="post-title" name="post_title" value="{{$post->post_title}}">
			    @error('post_title')
                    <span class="invalid-feedback" role="alert" style="display: block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			  </div>
			  <div class="form-group">
			    <label for="post-content">Post Content:</label>
			    <textarea class="form-control" id="post-content" placeholder="Enter Post Content" name="post_content" value="{{$post->post_content}}">{{$post->post_content}}</textarea>
			    @error('post_content')
                    <span class="invalid-feedback" role="alert" style="display: block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			  </div>
			  <img src="{{asset('storage/images/'.$post->post_img)}}" width="50px" height="50px">
			  <label for="post-image">Select Image:</label>
			    <input type="file" class="form-control" id="post-image" name="post_img">
			  <div class="form-group form-check">
			    <label class="form-check-label">
			      <input class="form-check-input" type="checkbox"> Remember me
			    </label>
			  </div>
			  <button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection