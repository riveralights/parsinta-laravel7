<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('post.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store()
    {
        //  validate the field
        $attr = request()->validate([
            'title' => 'required|min:3',
            'body' => 'required',
        ]);
        // Assign title to the slug
        $attr['slug'] = Str::slug(request('title'));

        // Create new post
        Post::create($attr);

        // redirect to index
        return redirect()->route('post.index');
    }
}
