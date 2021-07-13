<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('post, delete');
    }

    public function index()
    {
        $posts = Post::latest()->with(['user', 'likes'])->paginate(3);
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('post.show', [
            'post' => $post
    ]);

    }
    public function post(Request $request)
    {
       $this->validate($request, [
           'body'=> 'required'
       ]);

       $request->user()->posts()->create([
           'body' => $request->body,
       ]);

       return back();
    }
    public function delete(Post $post)
    {
        //Authorise post user
        $this->authorize('delete', $post);

        $post->delete();
        return back();
    }
}
