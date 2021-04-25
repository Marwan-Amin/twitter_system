<?php

namespace App\Services;

use App\Repositories\Tweet\TweetRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TweetService
{
    public function __construct(TweetRepositoryInterface $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function create($data)
    {
        return  DB::transaction(function () use ($data) {
            $tweet = $this->tweetRepository->create([
                'user_id' => auth()->user()->id,
                'tweet' => $data['tweet']
            ]);
            auth()->user()->incrementTweets();
            return $tweet;
        });
    }
}
