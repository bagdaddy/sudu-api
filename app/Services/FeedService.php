<?php

namespace App\Services;

use App\Dto\PostDTO;
use App\Exceptions\PostNotFoundException;
use App\Models\Comment;
use App\Models\Post;
use App\Repository\CommentRepository;
use App\Repository\FeedRepository;
use App\Repository\LikesRepository;
use App\Repository\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class FeedService
{
    private UserRepository $userRepository;
    private FeedRepository $feedRepository;
    private LikesRepository $likesRepository;
    private CommentRepository $commentRepository;

    public function __construct(
        UserRepository $userRepository,
        FeedRepository $feedRepository,
        LikesRepository $likesRepository,
        CommentRepository $commentRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->feedRepository = $feedRepository;
        $this->likesRepository = $likesRepository;
        $this->commentRepository = $commentRepository;
    }

    public function getUserMediaFeed(): Collection
    {
        $user = $this->userRepository->getOneById(Auth::id());
        $userIds = $user->friends->pluck('friend_id')->toArray();
        $userIds[] = $user->id;
        return $this->feedRepository->getByUserIds($userIds);
    }

    public function getPostsByUserId(int $userId): Collection
    {
        return $this->feedRepository->getByUserIds([$userId]);
    }

    public function likeOrUnlikePost(int $postId)
    {
        $userId = Auth::id();
        if ($this->likesRepository->exists($userId, $postId)) {
            $this->likesRepository->delete($userId, $postId);

            return;
        }

        $this->likesRepository->create(
            [
                'post_id' => $postId,
                'user_id' => $userId,
            ]
        );
    }

    public function createPost(PostDTO $postCreate): Post
    {
        $user = Auth::id();
        $post = $this->feedRepository->create(
            [
                'user_id' => $user,
                'body' => $postCreate->getBody(),
            ]
        );

        $post->pooPin()->create($postCreate->getCoordinates());

        return $post;
    }

    /**
     * @param PostDTO $postEdit
     * @param int $postId
     * @return Post
     * @throws PostNotFoundException|UnauthorizedException
     */
    public function editPost(PostDTO $postEdit, int $postId): Post
    {
        $post = $this->feedRepository->getOneById($postId);

        $post->body = $postEdit->getBody();
        $post->save();

        return $post;
    }

    /**
     * @param int $postId
     * @throws PostNotFoundException
     */
    public function deletePost(int $postId): void
    {
        $post = $this->feedRepository->getOneById($postId);
        if ($post === null) {
            throw new PostNotFoundException(__('exceptions.feed.post_not_found', ['id' => $postId]), 404);
        }
        $post->delete();
    }

    public function postComment(array $data, int $postId): Comment
    {
        $userId = Auth::id();

        return $this->commentRepository->save(
            [
                'user_id' => $userId,
                'post_id' => $postId,
                'comment' => $data['comment'],
            ]
        );
    }

    public function editComment(array $data, int $commentId): Comment
    {
        $comment = $this->commentRepository->getOneById($commentId);
        $comment->update(
            [
                'comment' => $data['comment'],
            ]
        );

        return $comment;
    }

    public function deleteComment(int $commentId): void
    {
        $user = $this->userRepository->getOneById(Auth::id());
        $user->comments()->where('id', '=', $commentId)
            ->delete();
    }
}
