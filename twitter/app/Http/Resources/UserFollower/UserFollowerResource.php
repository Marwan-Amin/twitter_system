<?php

namespace App\Http\Resources\UserFollower;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFollowerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' => (new UserResource($this->user))->only('id', 'name', 'image'),
            'following' => (new UserResource($this->following))->only('id', 'name', 'image')
        ];
    }
}
