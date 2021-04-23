<?php

namespace App\Http\Resources\UserFollower;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserFollowerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
