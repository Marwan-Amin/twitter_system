<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\Tweet\TweetResource;
use App\Services\TweetService;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function __construct(TweetService $tweetService, ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
        $this->tweetService = $tweetService;
    }

    public function create(TweetRequest $request)
    {
        $tweet = $this->tweetService->create($request->validated());
        return $this->apiResponse->setSuccess(__('tweet.created'))->setData(new TweetResource($tweet))->returnJson();
    }
}
