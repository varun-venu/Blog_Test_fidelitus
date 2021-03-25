<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postAddForm()
    {
        return view('createPost');
    }
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_title' => 'required',
            'post_content' => 'required'
        ]);
        if($request->hasFile('post_img')){
            $filenameWithExt = $request->file('post_img')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('post_img')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $request->file('post_img')->storeAs('public/images', $fileNameToStore);
        
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'post_title' => $request->post_title,
            'post_content' => $request->post_content,
            'post_img' => $fileNameToStore
        ]);
        if($post) {
            return redirect()->route('home')->with('status', 'Post Created Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['user', 'comments'])->find($id);
        return view('viewPost')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('editPost')->with('post', $post);
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
        $this->validate($request, [
            'post_title' => 'required',
            'post_content' => 'required'
        ]);
        $post = Post::find($id);
        if($request->hasFile('post_img')){
            $filenameWithExt = $request->file('post_img')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('post_img')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $request->file('post_img')->storeAs('public/images', $fileNameToStore);
        
        } else {
            $fileNameToStore = $post->post_img;
        }
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_img = $fileNameToStore;
        if($post->save()) {
            return redirect()->route('home')->with('status', 'Post Updated Successfully!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id == $post->user_id) {
            $post->delete();
        }
        return redirect()->back();
    }
}
