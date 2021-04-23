<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFollowerRequest;
use App\Http\Resources\UserFollower\UserFollowerResource;
use App\Repositories\UserFollower\UserFollowerRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserFollowerRepositoryInterface $userFollower, ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
        $this->userFollower = $userFollower;
    }

    public function follow(UserFollowerRequest $request)
    {
        $userFollower = $this->userFollower->create([
            'follower_id' => auth()->user()->id,
            'user_id' => $request->user_id
        ]);
        return $this->apiResponse->setSuccess(__('user.follow_success'))->setData(new UserFollowerResource($userFollower))->returnJson();
    }
}
