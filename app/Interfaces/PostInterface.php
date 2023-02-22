<?php

namespace App\Interfaces;

interface PostInterface
{
    public function getAllPosts();
    public function getUserPosts($userId);
    public function getPostsByCategory($categoryId);
    public function createPost($request);
    public function getPostById($postId);
    public function updatePost($request, $postId);
    public function deletePost($postId);
}
