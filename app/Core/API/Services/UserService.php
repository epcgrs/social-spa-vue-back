<?php

namespace App\Core\API\Services;

use App\Core\API\Repositories\Contracts\IUserRepository;
use App\Core\API\Services\Contracts\IUserService;
use App\Core\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    /* @var IUserRepository */
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function save(array $data): ?User
    {
        $data['password'] = Hash::make( $data['password'] );

        return $this->userRepository->save($data);
    }

    public function login(Request $request): ?User
    {
        $email      = $request->input('email');
        $password   = $request->input('password');
        $user       = $this->userRepository->byEmail($email);

        if ($user  &&  Hash::check($password, $user->makeVisible('password')->password)) {
            auth()->login($user);
            return $user;
        }
        return NULL;

    }

    public function logout(): bool
    {
        if (auth()->user()) {
            auth()->logout();
            return true;
        }

        return false;
    }



}
