@extends('layouts.app') @section('title', $post->title) @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if($post->thumbnail)
            <img style="height: 550px; object-fit: cover; object-position:center; " src="{{ asset($post->takeImage) }}" alt="" class="rounded w-100">
            @endif
            <h1 class="mt-3">{{ $post->title }}</h1>
            <div class="text-secondary my-2">
                <a
                    href="/categories/{{ $post->category->slug }}"
                    >{{ $post->category->name }}</a
                >
                &middot; {{ $post->created_at->format('d F, Y') }}
                &middot; @foreach ($post->tags as $tag)
                <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
                @endforeach

                <div class="media align-items-center my-3">
                    <img width="40" src="{{ $post->author->gravatar() }}" class="rounded-circle mr-3">
                    <div class="media-body">
                        <div>
                            {{ $post->author->name }}
                        </div>
                        {{ '@' . $post->author->username }}
                    </div>
                </div>
            </div>
            <p>{!! nl2br($post->body) !!}</p>
            <div>
                @can('delete', $post)
                <div class="flex">
                    <!-- Button trigger modal -->
                    <button
                    type="button"
                    class="btn btn-danger"
                    data-toggle="modal"
                    data-target="#exampleModal"
                    >
                        Destroy
                    </button>

                    <a
                        href="{{ route('post.edit', $post) }}"
                        class="btn btn-success"
                        >Edit</a
                    >
                </div>
                

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
                @endcan
            </div>
        </div>
        <div class="col-md-4">
            <div class="list-group">
                <h3 class="list-group-item list-group-item-action active">
                  Baca yang lainnya
                </h3>
                @foreach ($posts as $post)
                    <a href="{{ route('post.show', $post->slug) }}" class="list-group-item list-group-item-action">{{ $post->title }}</a>
                @endforeach
              </div>
        </div>
    </div>
</div>
@endsection
