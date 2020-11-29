@extends('layouts.app') @section('title', $post->title) @section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <div class="text-secondary my-2">
        <a
            href="/categories/{{ $post->category->slug }}"
            >{{ $post->category->name }}</a
        >
        &middot; {{ $post->created_at->format('d F, Y') }}
        &middot; @foreach ($post->tags as $tag)
        <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
        @endforeach
    </div>
    <hr />
    <p>{{ $post->body }}</p>
    <div>
        <div class="text-secondary mb-3">
            Penulis : {{ $post->author->name }}
        </div>
        {{-- @if(auth()->user()->is($post->author)) --}}
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-link text-danger btn-sm p-0"
            data-toggle="modal"
            data-target="#exampleModal"
        >
            Destroy
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Apakah anda yakin ingin menghapusnya
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Data Posting <br />
                        Judul : {{ $post->title }} <br />
                        Tanggal Dibuat :
                        {{ $post->created_at->diffForHumans() }}
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <form
                            action="{{ route('post.destroy', $post) }}"
                            method="POST"
                        >
                            @csrf @method('delete')
                            <button class="btn btn-danger" type="submit">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endif --}}
    </div>
</div>
@endsection
