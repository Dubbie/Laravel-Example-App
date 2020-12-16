@extends('layouts.old')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-8 offset-2">
                <div class="card card-body">
                    <h1>Posts</h1>
                    <a href="{{ action('PostController@create') }}" class="btn btn-sm btn-primary">New post</a>
                    <hr>
                    @php /** @var \App\Models\Post $post */ @endphp
                    <div class="list-group">
                        @foreach($posts as $post)
                            <a href="{{ action('PostController@show', $post) }}" class="list-group-item text-dark">
                                <h5 class="fw-bold">{{ $post->title }}</h5>
                                <p class="mb-3"><small><b>{{ $post->author->name }}</b> - {{ $post->created_at->format('Y-m-d H:i') }}</small></p>
                                <p class="mb-0">{{ \Illuminate\Support\Str::limit($post->content, 250) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection