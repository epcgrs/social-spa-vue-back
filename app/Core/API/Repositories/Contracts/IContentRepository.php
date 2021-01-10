<?php

namespace App\Core\API\Repositories\Contracts;

use App\Core\Entities\Content;
use App\Core\Entities\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IContentRepository
{
    public function byId(int $id): ?Content;
    public function save(array $data): ?Content;
    public function toggleLike(int $contentId): ?int;
    public function listPostsByFriends(int $userId): LengthAwarePaginator;
    public function listUserPosts(int $userId): LengthAwarePaginator;
    public function getAuthor(int $key): User;
}
