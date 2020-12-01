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
        // ambil post yang terakhir, dipaginasi 6 item per halaman
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
        // validasi untuk gambar, pastikan formatnya image
        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        // tangkap semua request dari form
        $attr = $request->all();

        // Assign title to the slug
        $slug = Str::slug(request('title'));
        $attr['slug'] = $slug;

        // tanya, apakah dari form ada request untuk gambar? jika iya, tangkap dan simpan gambar
        // jika tidak, berikan nilai null, karena di database itu nullable
        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("images/post") : null;

        // tangkap gambarnya
        // Ambil alamatnya dan simpan file ke storage
        // $thumbnailUrl = $thumbnail->storeAs("images/post", "{$slug}.{$thumbnail->extension()}");

        // masukkan kategori dan gambar thumbnail
        $attr['category_id'] = request('category');
        // masukkan gambarnya
        $attr['thumbnail'] = $thumbnail;

        // Create new post
        $post = auth()->user()->posts()->create($attr);

        // insert tag ke pivot table
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
        // hanya yang punya autorisasi yang bisa update
        $this->authorize('update', $post);

        // lakukan validasi untuk format gambar
        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        // jika file gambarnya sudah ada
        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/post");
        } else {
            $thumbnail = $post->thumbnail;
        }

        // tangkap gambarnya dan simpan
        $thumbnail = request()->file('thumbnail')->store("images/post");

        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        $post->update($attr);
        $post->tags()->sync(request('tags'));

        return redirect()->route('post.index')->with('success', 'The post was updated');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('post.index')->with('success', 'The post was deleted');
    }
}
