<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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
        return view('post.create', [
            'post' => new Post,
            'label' => 'Create',
        ]);
    }

    public function store(PostRequest $request)
    {
        $attr = $request->all();
        // Assign title to the slug
        $attr['slug'] = Str::slug(request('title'));

        // Create new post
        Post::create($attr);

        // redirect to index
        return redirect()->route('post.index')->with('success', 'The post was created');
    }

    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
            'label' => 'Update'
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $attr = $request->all();

        $post->update($attr);

        return redirect()->route('post.index')->with('success', 'The post was updated');
    }
}
