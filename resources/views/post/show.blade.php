@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
        <div>
            <!-- Button trigger modal -->
<button type="button" class="btn btn-link text-danger btn-sm p-0" data-toggle="modal" data-target="#exampleModal">
    Destroy
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin menghapusnya</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Data Posting <br>
            Judul : {{ $post->title }} <br>
            Tanggal Dibuat : {{ $post->created_at->diffForHumans() }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <form action="{{ route('post.destroy', $post) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form> 
        </div>
      </div>
    </div>
  </div>
        </div>
    </div>
@endsection