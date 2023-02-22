<?php

namespace App\Repositories;

use App\Interfaces\PostInterface;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Response;

class PostRepository implements PostInterface
{

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

    public function getPostsByBrand($brandId)
    {
        return Brand::find($brandId)->posts;
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

    public function searchPost($request, $searchWord)
    {
        $posts = Post::where('title', 'like', '%' . $searchWord . '%');

        if (count($posts->get()) == 0) return $this->success('No content', Response::HTTP_NO_CONTENT);

        if ($request->query('min_price')) {
            $posts->where('price', '>=', $request->input('min_price'));
        }

        if ($request->query('max_price')) {
            $posts->where('price', '<=', $request->input('max_price'));
        }

        if ($request->query('rate')) {
            $posts->where('rate', '=', $request->input('rate'));
        }

        if($request->query('brand_id')) {
            $posts->where('brand_id', '=', $request->input('brand_id'));
        }

        return $posts->get();


    }
}
