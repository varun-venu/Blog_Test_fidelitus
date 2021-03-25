@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Your Posts</h1>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Post Title</th>
                            <th>Post Content</th>
                            <th>Image</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->posts as $post)
                              <tr>
                                <td>{{$post->post_title}}</td>
                                <td>{{$post->post_content}}</td>
                                <td><img src="{{asset('storage/images/'.$post->post_img)}}" width="50px" height="50px"></td>
                                <td>
                                    <a href="{{route('posts.edit',$post->id)}}">Edit</a> | <a href="#" class="delete"> Delete </a>
                                    <form method="POST" action="{{route('posts.destroy', $post->id)}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                              </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click", ".delete", function() {
            $(this).next('form').submit();
        });
    });
</script>
@endsection
