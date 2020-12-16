@extends('layouts.old')

@php /** @var \App\Models\Post $post */ @endphp
@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-8 offset-2">
                <div class="card card-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-8">
                            <h1 class="fw-bold">{{ $post->title }}</h1>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <a href="{{ action('PostController@edit', $post) }}" class="btn btn-sm btn-success me-2">Edit</a>
                            <form action="{{ action('PostController@destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button id="btn-del-post" type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                    <p>{{ $post->content }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(() => {
            const delPost = document.getElementById('btn-del-post');
            $(delPost).on('click', e => {
                if (!confirm('You are about to delete this post. This action is irreversible.')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection