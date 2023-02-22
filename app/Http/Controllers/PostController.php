<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Traits\GlobalTrait;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;


class PostController extends Controller
{
    use GlobalTrait;

    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->getAllPosts();

        return $this->success(trans('messages.SUCCESS'), 200, $posts);
    }

    public function store(CreatePostRequest $request)
    {
        try {
            $post = $this->postRepository->createPost($request);
            if ($post) {
                return $this->success(trans('messages.SUCCESS'), Response::HTTP_CREATED, $post);
            }
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function show($postId)
    {
        try {
            $post = $this->postRepository->getPostById($postId);

            if ($post) {
                return $this->success(trans('messages.SUCCESS'), Response::HTTP_OK, $post);
            }
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function update(UpdatePostRequest $request, $postId)
    {
        try {
            $post = $this->postRepository->updatePost($request, $postId);

            if ($post) {
                return $this->success(trans('messages.SUCCESS'), Response::HTTP_CREATED, $post);
            }
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($postId)
    {
        try {
            $this->postRepository->deletePost($postId);

            return $this->success(trans('messages.SUCCESS'), Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function userPosts($userId)
    {
        try {
            $posts = $this->postRepository->getUserPosts($userId);

            if ($posts) {
                return $this->success(trans('messages.SUCCESS'), Response::HTTP_OK, $posts);
            }
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function categoryPosts($categoryId)
    {
        try {
            $posts = $this->postRepository->getPostsByCategory($categoryId);

            if (count($posts) > 0) {
                return $this->success(trans('messages.SUCCESS'), Response::HTTP_OK, $posts);
            } else {
                return $this->error('No content', Response::HTTP_NO_CONTENT);
            }
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function brandPosts($brandId) {
        try {
            $posts = $this->postRepository->getPostsByBrand($brandId);

            if (count($posts) > 0) {
                return $this->success(trans('messages.SUCCESS'), Response::HTTP_OK, $posts);
            } else {
                return $this->error('No content', Response::HTTP_NO_CONTENT);
            }
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function search(Request $request, $searchWord)
    {
        try {
            $posts = $this->postRepository->searchPost($request, $searchWord);

            return $this->success(trans('message.SUCCESS'), Response::HTTP_CREATED, $posts);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

}
