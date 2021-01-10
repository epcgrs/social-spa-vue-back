<?php

namespace App\Core\API\Repositories\Contracts;

use App\Core\Entities\User;

interface IUserRepository
{
    public function save(array $data): ?User;
    public function byEmail(string $email): ?User;
    public function byId(int $key): ?User;
    public function toggleFriend(int $followerId, int $friendId): bool;
}
