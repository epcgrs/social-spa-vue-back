<?php

namespace App\Core\API\Repositories\Contracts;

use App\Core\Entities\User;
use Illuminate\Support\Collection;

interface IUserRepository
{
    public function save(array $data): ?User;
    public function byEmail(string $email): ?User;
    public function byId(int $key): ?User;
    public function toggleFriend(int $followerId, int $friendId): bool;
    public function userFriends(User $user): Collection;
    public function userPageFriends($id): Collection;
    public function userFollowers(User $user): Collection;
    public function userFollowersById(int $id): Collection;
}
