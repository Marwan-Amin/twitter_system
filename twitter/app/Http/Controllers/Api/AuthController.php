<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\User\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(UserRepositoryInterface $user, ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
        $this->user = $user;
    }

    public function register(AuthRequest $request)
    {
        $user = $this->user->create($request->validated());
        return $this->apiResponse->setSuccess(__('auth.register_success'))->setData(new UserResource($user))->returnJson();
    }
}
