<?php

namespace App\Core\API\Services\Contracts;

use App\Core\Entities\User;
use Illuminate\Http\Request;

interface IUserService
{
    public function save(array $data): ?User;
    public function login(Request $request): ?User;
    public function toggleFriend(int $followerId, int $friendId): bool;
}
