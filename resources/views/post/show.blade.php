@extends('layouts.old')

@php /** @var \App\Models\Post $post */ @endphp
@php /** @var \App\Models\Comment $comment */ @endphp
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

                    <hr>

                    <h5 class="fw-bold mb-2">Comments</h5>

                    @if($post->comments()->count() > 0)
                        @foreach($post->comments as $comment)
                            <div class="media d-flex">
                                <div class="media-body flex-grow-1">
                                    <p class="mb-1" style="line-height: 1;">
                                        <b>{{ $comment->author->name }}</b>
                                        <small class="d-block">{{ $comment->created_at->shortAbsoluteDiffForHumans() }} ago</small>
                                    </p>
                                    <p class="text-muted">{{ $comment->message }}</p>
                                </div>
                                <form action="{{ action('CommentController@destroy', $comment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-muted">Delete</button>
                                </form>
                            </div>
                        @endforeach()
                    @else
                        <p class="mb-3 text-muted">Be the first to comment!</p>
                    @endif

                    <form action="{{ action('CommentController@store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="comment-post-id" value="{{ $post->id }}">
                        <div class="form-group mb-3">
                            <label for="comment-message" class="form-label visually-hidden">Comment message</label>
                            <textarea name="comment-message" id="comment-message" class="form-control" cols="30" rows="2" maxlength="255" placeholder="Type here..."></textarea>
                        </div>
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                        </div>
                    </form>
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