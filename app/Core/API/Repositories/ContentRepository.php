<?php

namespace App\Core\API\Repositories;

use App\Core\API\Repositories\Contracts\IContentRepository;
use App\Core\Entities\Content;
use App\Core\Entities\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class ContentRepository implements IContentRepository
{
    public function byId(int $id): ?Content
    {
        return Content::with('user')->find($id);
    }

    public function save(array $data): ?Content
    {

        $entity = new Content();

        if( ! empty($data[$entity->getKeyName()]))
        {
            $entityFound = Content::find($data[$entity->getKeyName()]);

            if(!is_null($entityFound))
                $entity = $entityFound;
        }

        return $entity->fill($data)->save() ? $entity : NULL;
    }

    public function toggleLike(int $contentId): ?int
    {

        if(Auth::user()->likes()->toggle($contentId)) {
            $content = Content::find($contentId);
            return $content->likes()->count();
        }

        return NULL;
    }

    public function listPostsByFriends(int $userId): LengthAwarePaginator
    {
        $contents = Content::with('user', 'likes', 'comments', 'comments.user')->orderBy('created_at', 'DESC')->paginate(10);

        foreach ($contents as $content) {
            $content->count_likes = $content->likes()->count();

            if ($liked = auth()->user()->likes()->find($content->id)) {
                $content->already_liked = true;
            } else {
                $content->already_liked = false;
            }

            $content->count_comments = $content->comments()->count();

        }

        return $contents;

    }

    public function listUserPosts(int $userId): LengthAwarePaginator
    {
        $user = User::find($userId);

        if ($user) {
            return $user->contents()->with('user', 'likes', 'comments', 'comments.user')->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            return $user;
        }
    }

    public function getAuthor(int $key): User
    {
        return User::find($key);
    }


}
