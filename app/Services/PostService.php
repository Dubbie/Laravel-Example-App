<?php

namespace App\Services;


use App\DTO\PostDTO;
use App\Models\Post;

class PostService
{
    /**
     * Létrehoz egy új bejegyzést.
     *
     * @param PostDTO $postDTO
     */
    public function createPost(PostDTO $postDTO) {
        $post = new Post();
        $post->title = $postDTO->getTitle();
        $post->content = $postDTO->getContent();
        $post->author_id = $postDTO->getAuthorId();
        $post->save();

        \Log::info('Új bejegyzés elmentve.');
    }

    /**
     * Létrehoz egy új bejegyzést.
     *
     * @param $postId
     * @param $title
     * @param $content
     */
    public function updatePost($postId, $title, $content) {
        $post = Post::find($postId);
        $post->title = $title;
        $post->content = $content;
        $post->save();

        \Log::info('Bejegyzés frissítve.');
    }

    /**
     * Visszaadja az összes postot.
     *
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPosts() {
        return \Auth::user()->posts;
    }

    /**
     * Kitörli a megadott bejegyzést.
     *
     * @param Post $post
     * @return bool
     */
    public function deletePost(Post $post) {
        try {
            $id = $post->id;
            $post->delete();

            \Log::info(sprintf('Bejegyzés törölve (Azonosító: %s)', $id));
            return true;
        } catch (\Exception $e) {
            \Log::error('Hiba történt a bejegyzés törlésekor.');
            return false;
        }
    }
}