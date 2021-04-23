<?php

namespace App\Rules;

use App\Models\UserFollower;
use Illuminate\Contracts\Validation\Rule;

class ValidateNotFollowingUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $userFollowers = UserFollower::where('user_id', $value)->where('follower_id', auth()->user()->id)->get();
        if (count($userFollowers) != 0) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('user.already_following');
    }
}
