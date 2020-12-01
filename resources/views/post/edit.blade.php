@extends('layouts.app')
@section('title', 'Update post')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @include('alert')
            <div class="card">
                <div class="card-header">Update Post : {{ $post->title }}</div>
                <div class="card-body">
                    <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        @include('post.partials.form-control')
                        <button type="submit" class="btn btn-primary">{{ $label }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection