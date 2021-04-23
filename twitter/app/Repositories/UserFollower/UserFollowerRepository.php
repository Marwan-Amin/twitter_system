<?php

namespace App\Repositories\UserFollower;

use App\Models\UserFollower;
use App\Repositories\Base\BaseRepository;
use App\Repositories\UserFollower\UserFollowerRepositoryInterface;

class UserFollowerRepository extends BaseRepository implements UserFollowerRepositoryInterface
{
    public function __construct(UserFollower $model)
    {
        parent::__construct($model);
    }
}
