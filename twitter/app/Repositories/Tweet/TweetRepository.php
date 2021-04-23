<?php

namespace App\Repositories\Tweet;

use App\Models\Tweet;
use App\Repositories\Base\BaseRepository;

class TweetRepository extends BaseRepository implements TweetRepositoryInterface
{
    public function __construct(Tweet $model)
    {
        parent::__construct($model);
    }
}
