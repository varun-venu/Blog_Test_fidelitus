<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'post_comment' => 'required'
    	]);
    	$comment = Comment::create([
    		'user_id' => auth()->user()->id,
			'post_id' => $request->post_id,
			'comments' => $request->post_comment
    	]);
    	if($comment) {
    		return redirect()->back();
    	}
    }
}
