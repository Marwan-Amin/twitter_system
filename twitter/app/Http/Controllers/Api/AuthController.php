<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\User\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

    public function login(Request $request)
    {
        // Validate sign in input data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse->setError($validator->errors()->first())->setData()->returnJson();
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return $this->apiResponse->setError(__('auth.failed'))->setData()->returnJson();
        }

        // Access and refresh token generation
        $client = Client::where('password_client', 1)->first();
        $params = [
            "grant_type" => "password",
            "client_id" => $client->id,
            "client_secret" => $client->secret,
            "username" => $request->email,
            "password" => $request->password,
            "scope" => null,
        ];
        $request->request->add($params);
        $proxy = Request::create('oauth/token', 'POST');
        $token = Route::dispatch($proxy);
        $response = json_decode($token->getContent(), true);
        return $this->apiResponse->setSuccess(__('auth.login_success'))->setData($response)->returnJson();
    }
}
