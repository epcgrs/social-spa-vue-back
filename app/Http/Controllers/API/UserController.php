<?php

namespace App\Http\Controllers\API;

use App\Core\API\Services\Contracts\IUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Login;
use App\Http\Requests\API\UserSave;
use App\Http\Requests\API\UserUpdate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /* @var IUserService */
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserSave $request)
    {
        $data = $request->all();

        if ($user = $this->userService->save($data)) {
            if($user->token = $user->createToken($user->email)->accessToken ) {
                return json_encode([
                    'status' => true,
                    'user' => $user
                ]);
            }
        }
        return json_encode(['status', false]);
    }

    public function update(UserUpdate $request)
    {
        $data = $request->all();
        if ($user = $this->userService->save($data)) {

            if($user->token = $user->createToken($user->email)->accessToken ) {
                return json_encode([
                    'status' => true,
                    'user' => $user
                ]);
            }
        }
        return json_encode(['status', false]);
    }

    public function login(Login $request)
    {
        if ($user = $this->userService->login($request)) {

            $user->token = $user->createToken($user->email)->accessToken;

            return response()->json([
                'status' => true,
                'user' => $user
            ]);

        }
        return response()->json(['status' => false], 200);
    }

    public function toggleFriend(Request $request)
    {
        $friendId = $request->input('user_id');
        $followerId = $request->input('logged_id');

        if ($this->userService->toggleFriend($followerId, $friendId)) {
            return json_encode([
                'status' => true,
            ]);
        }

        return json_encode(['status' => false]);
    }


    public function userFriends(Request $request)
    {
        $user = $request->user();

        if($friends = $this->userService->userFriends($user)) {
            return json_encode([
                'status'=> true,
                'friends' => $friends,
                'followers' => $this->userService->userFollowers($user),
            ]);
        }

        return json_encode(['status'=>false]);
    }

    public function userPageFriends($id, Request $request)
    {
        $user = $request->user();

        if($friends = $this->userService->userPageFriends($id)) {
            return json_encode([
                'status'=> true,
                'friends' => $friends,
                'auth_friends' => $this->userService->userFriends($user),
                'followers' => $this->userService->userFollowersById($id),
            ]);
        }

        return json_encode(['status'=>false]);
    }
}
