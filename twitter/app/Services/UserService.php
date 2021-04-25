<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserFollower\UserFollowerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function __construct(UserFollowerRepositoryInterface $userFollowerRepository, UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userFollowerRepository = $userFollowerRepository;
    }

    public function create($data)
    {
        return DB::transaction(function () use ($data) {
            $tweet = $this->userFollowerRepository->create([
                'follower_id' => auth()->user()->id,
                'user_id' => $data['user_id']
            ]);
            auth()->user()->incrementFollowing();
            $this->userRepository->find($data['user_id'])->incrementFollowers();
            return $tweet;
        });
    }
}
