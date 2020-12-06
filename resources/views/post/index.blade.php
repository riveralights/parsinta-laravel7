@extends('layouts.app') @section('content')
<div class="container">
    <div class="">
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
    </div>
    <div class="row">
        <div class="col-md-6">
            @forelse ($posts as $post)
                <div class="card mb-3">
                    <a href="{{ route('post.show', $post) }}" class="card-header">{{ $post->title }}</a>
                    @if ($post->thumbnail)
                    <a href="{{ route('post.show', $post) }}">
                        <img style="height: 400px; object-fit: cover; object-position:center; " src="{{ asset($post->takeImage) }}" alt="" class="card-img-top">
                    </a>
                    @endif

                    <div class="card-body">
                        <div>
                            <a href="{{ route('categories.show', $post->category->slug) }}" class="text-secondary mb-2  ">
                                <small>{{ $post->category->name }} - </small>
                            </a>
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('tags.show', $tag->slug) }}" class="text-secondary">
                                    <small>{{ $tag->name }}</small>
                                </a>   
                            @endforeach
                        </div>
                        <div class="mt-3">
                            {{ Str::limit($post->body, 130, '.') }}
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="media align-items-center">
                                <img width="40" src="{{ $post->author->gravatar() }}" class="rounded-circle mr-3">
                                <div class="media-body">
                                    <div>
                                        {{ $post->author->name }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-secondary">
                                <small>Published on {{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div class="col">
                <div class="alert alert-info">There's no post.</div>
            </div>
            @endforelse
        </div>
    </div>
    
    {{ $posts->links() }}
</div>
@endsection
