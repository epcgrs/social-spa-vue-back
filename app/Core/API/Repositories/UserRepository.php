<?php

namespace App\Core\API\Repositories;

use App\Core\API\Repositories\Contracts\IUserRepository;
use App\Core\Entities\User;

class UserRepository implements IUserRepository
{
    public function save(array $data): ?User
    {
        $user = new User();
        $user->fill($data);

        if ($user->save())
            return $user;

        return NULL;
    }

    public function byEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

}
