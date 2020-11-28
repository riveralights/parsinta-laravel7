@extends('layouts.app') @section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            @isset ($category)
            <h4>Category : {{ $category->name }}</h4>
            @endisset @isset ($tag)
            <h4>Tag : {{ $tag->name }}</h4>
            @endisset @if (!isset($tag) && !isset($category))
            <h4>All Post</h4>
            @endif
            <hr />
        </div>
        <div>
            @if(Auth::check())
            <a href="{{ route('post.create') }}" class="btn btn-primary"
                >New Post</a
            >
            @else
            <a href="{{ route('post.create') }}" class="btn btn-primary"
                >Login to create a new post</a
            >
            @endif
        </div>
    </div>
    <div class="row">
        @forelse ($posts as $post)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">{{ $post->title }}</div>
                <div class="card-body">
                    <div>
                        {{ Str::limit($post->body, 100, '.') }}
                    </div>
                    <a href="{{ route('post.show', $post) }}">Read More</a>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    Published on {{ $post->created_at->diffForHumans() }}
                    @auth
                    <a
                        href="{{ route('post.edit', $post) }}"
                        class="btn btn-success"
                        >Edit</a
                    >
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <div class="alert alert-info">There's no post.</div>
        </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
