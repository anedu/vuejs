<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function show (Request $request) {
        $posts = Post::all();
        return $posts;
    }
    public function delete (Request $request) {
        $post = Post::find($request->id);
        $post->delete();
        return redirect()->back();
    }
    public function create (Request $request) {
        $post = new Post();
        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();
        return redirect()->back();
    }
    public function update(Request $request) {
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();
        return redirect()->back();
    }    
}