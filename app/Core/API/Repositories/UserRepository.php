<?php

namespace App\Core\API\Repositories;

use App\Core\API\Repositories\Contracts\IUserRepository;
use App\Core\Entities\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements IUserRepository
{
    public function save(array $data): ?User
    {
        $entity = new User();

        if( ! empty($data[$entity->getKeyName()]))
        {
            $entityFound = User::find($data[$entity->getKeyName()]);

            if(!is_null($entityFound))
                $entity = $entityFound;
        }

        return $entity->fill($data)->save() ? $entity : NULL;
    }

    public function byEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function byId(int $key): ?User
    {
        return User::find($key);
    }

    public function toggleFriend(int $followerId, int $friendId): bool
    {
        $follower = User::find($followerId);

        if (!$follower || ($followerId == $friendId)) {
            return FALSE;
        }

        if ($follower->friends()->toggle($friendId)) {
            return TRUE;
        }

        return FALSE;
    }

}
