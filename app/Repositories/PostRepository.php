<?php

namespace App\Repositories;

use App\Interfaces\PostInterface;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostRepository implements PostInterface {

    public function getAllPosts()
    {
        return Post::all();
    }

    public function getUserPosts($userId)
    {
        return User::find($userId)->posts;
    }

    public function getPostsByCategory($categoryId)
    {
        return Category::find($categoryId)->posts;
    }

    public function createPost($request)
    {
        return Post::create([
             'title' => $request->title,
             'content' => $request->content
         ]);
    }

    public function getPostById($postId)
    {
        return Post::find($postId);
    }

    public function updatePost($request, $postId)
    {
        $post = Post::find($postId);
        $post?->update($request->all());

        return $post;
    }

    public function deletePost($postId)
    {
        $post = Post::find($postId);

        $post?->delete();
    }
}
