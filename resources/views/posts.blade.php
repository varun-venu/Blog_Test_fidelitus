@extends('layouts.app')

@section('content')
<section>
  <div class="container py-3">
  	@foreach($posts as $post)
    <div class="card">
      <div class="row ">
        <div class="col-md-4">
            <img src="{{asset('storage/images/'.$post->post_img)}}" width="100px" height="100px">
          </div>
          <div class="col-md-8 px-3">
            <div class="card-block px-3">
              <h4 class="card-title mt-4">{{$post->post_title}}</h4>
              <p class="card-text">{{(strlen($post->post_content) > 5) ? substr($post->post_content,0,10).'...' : $post->post_content}}</p>
              <p class="float-right">Posted By, {{$post->user->name}}</p>
              <a href="{{route('posts.show', $post->id)}}" class="btn btn-primary mb-4">Read More</a>
            </div>
          </div>

        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection