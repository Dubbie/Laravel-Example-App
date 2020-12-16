<?php

namespace App\Http\Controllers;

use App\DTO\PostDTO;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /** @var PostService */
    private $postService;

    /**
     * PostController constructor.
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index')->with([
            'posts' => $this->postService->getPosts(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'post-title' => 'required',
            'post-content' => 'required'
        ]);

        $pdto = (new PostDTO())->setAuthorId(\Auth::id())
            ->setTitle($data['post-title'])
            ->setContent($data['post-content']);
        $this->postService->createPost($pdto);

        return redirect(action('PostController@index'))->with([
            'success' => 'New post created successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param   $postId
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $post = \Auth::user()->posts()->find($postId);

        if ($post) {
            return view('post.show')->with([
                'post' => $post
            ]);
        } else {
            return redirect(action('PostController@index'))->with([
                'error' => '404 not found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $postId
     * @return \Illuminate\Http\Response
     */
    public function edit($postId)
    {
        $post = \Auth::user()->posts()->find($postId);
        return view('post.edit')->with([
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'post-title' => 'required',
            'post-content' => 'required'
        ]);

        $this->postService->updatePost($post->id, $data['post-title'], $data['post-content']);
        return redirect(action('PostController@show', $post))->with([
            'success' => 'Post updated successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $postId
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId)
    {
        /** @var Post $post */
        $post = \Auth::user()->posts()->find($postId);

        if ($this->postService->deletePost($post)) {
            return redirect(action('PostController@index'))->with([
                'success' => 'Post deleted successfully',
            ]);
        }

        return redirect(action('PostController@index'))->with([
            'error' => 'Error while deleting post',
        ]);
    }
}
