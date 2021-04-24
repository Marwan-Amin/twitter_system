<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFollowerRequest;
use App\Http\Resources\UserFollower\UserFollowerResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(UserService $userService, ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
        $this->userService = $userService;
    }

    public function follow(UserFollowerRequest $request)
    {
        $userFollower = $this->userService->create($request->validated());
        return $this->apiResponse->setSuccess(__('user.follow_success'))->setData(new UserFollowerResource($userFollower))->returnJson();
    }
}
