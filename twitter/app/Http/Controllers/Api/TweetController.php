<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\Tweet\TweetResource;
use App\Repositories\Tweet\TweetRepositoryInterface;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function __construct(TweetRepositoryInterface $tweet, ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
        $this->tweet = $tweet;
    }

    public function create(TweetRequest $request)
    {
        $tweet = $this->tweet->create($request->validated());
        return $this->apiResponse->setSuccess(__('tweet.created'))->setData(new TweetResource($tweet))->returnJson();
    }
}
