<?php

namespace App\Services;

class UserFollowerService
{
    public function follow($data)
    {
        $this->user->create([
            'follower_id' => auth()->user()->id,
            'user_id' => $data['']
        ]);
    }
}
