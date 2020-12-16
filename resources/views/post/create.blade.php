@extends('layouts.old')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-8 offset-2">
                <div class="card card-body">
                    <h1>New Post</h1>
                    <hr>
                    <form action="{{ action('PostController@store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="post-title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="post-title" name="post-title" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="post-content" class="form-label">Content</label>
                            <textarea name="post-content" id="post-content" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Save post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection