<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CommentPostRequest;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\DeleteCommentRequest;
use App\Http\Requests\Posts\DeletePostRequest;
use App\Http\Requests\Posts\EditCommentRequest;
use App\Http\Requests\Posts\EditPostRequest;
use App\Http\Requests\Posts\LikePostRequest;
use App\Normalizer\PostNormalizer;
use App\Services\FeedService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FeedController
{
    private FeedService $feedService;
    private PostNormalizer $postNormalizer;

    public function __construct(FeedService $feedService, PostNormalizer $postNormalizer)
    {
        $this->feedService = $feedService;
        $this->postNormalizer = $postNormalizer;
    }

    public function getPosts(int $userId): JsonResponse
    {
        $posts = $this->feedService->getPostsByUserId($userId);

        return response()->json($posts);
    }

    public function getFeed(): JsonResponse
    {
        $posts = $this->feedService->getUserMediaFeed();

        return response()->json($posts);
    }

    public function likeOrUnlikePost(LikePostRequest $request): Response
    {
        $postId = $request->getModelId();
        $this->feedService->likeOrUnlikePost($postId);

        return response()->noContent(200);
    }

    public function deletePost(DeletePostRequest $request): Response
    {
        $postId = $request->getModelId();
        $this->feedService->deletePost($postId);

        return response()->noContent(200);
    }

    public function createPost(CreatePostRequest $request): JsonResponse
    {
        $data = $request->validated();
        $post = $this->feedService->createPost($this->postNormalizer->normalize($data));

        return response()->json($post);
    }

    public function editPost(EditPostRequest $request): JsonResponse
    {
        $data = $request->validated();
        $post = $this->feedService->editPost($this->postNormalizer->normalize($data), $request->getModelId());

        return response()->json($post);
    }

    public function postComment(CommentPostRequest $request): JsonResponse
    {
        $postId = $request->getModelId();
        $data = $request->validated();

        $comment = $this->feedService->postComment($data, $postId);

        return response()->json($comment);
    }

    public function editComment(EditCommentRequest $request): JsonResponse
    {
        $commentId = $request->getModelId();
        $data = $request->validated();
        $comment = $this->feedService->editComment($data, $commentId);

        return response()->json($comment);
    }

    public function deleteComment(DeleteCommentRequest $request): Response
    {
        $commentId = $request->getModelId();
        $this->feedService->deleteComment($commentId);

        return response()->noContent(200);
    }
}
