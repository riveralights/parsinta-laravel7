<?php

namespace App\Http\Controllers;

use App\{Tag, Post, Category};
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

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
            'categories' => Category::get(),
            'tags' => Tag::get(),
            'label' => 'Create',
        ]);
    }

    public function store(PostRequest $request)
    {
        $attr = $request->all();
        // Assign title to the slug
        $attr['slug'] = Str::slug(request('title'));
        $attr['category_id'] = request('category');

        // Create new post
        $post = auth()->user()->posts()->create($attr);

        $post->tags()->attach(request('tags'));

        // redirect to index
        return redirect()->route('post.index')->with('success', 'The post was created');
    }

    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get(),
            'label' => 'Update'
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $attr = $request->all();
        $attr['category_id'] = request('category');

        $post->update($attr);
        $post->tags()->sync(request('tags'));

        return redirect()->route('post.index')->with('success', 'The post was updated');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('post.index')->with('success', 'The post was deleted');
    }
}
