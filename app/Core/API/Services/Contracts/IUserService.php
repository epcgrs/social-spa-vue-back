<?php

namespace App\Core\API\Services\Contracts;

use App\Core\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IUserService
{
    public function save(array $data): ?User;
    public function login(Request $request): ?User;
    public function toggleFriend(int $followerId, int $friendId): bool;
    public function userFriends(User $user): Collection;
    public function userPageFriends($id): Collection;
    public function userFollowers(User $user): Collection;
    public function userFollowersById(int $id): Collection;
}
