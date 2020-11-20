@extends('layouts.app')
@section('title', 'Create new post')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @include('alert')
            <div class="card">
                <div class="card-header">New Post</div>
                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="post">
                        @csrf
                        @include('post.partials.form-control')
                        <button type="submit" class="btn btn-primary">{{ $label }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection