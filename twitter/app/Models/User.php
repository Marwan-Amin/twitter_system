<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'date_of_birth',
        'number_of_followers',
        'number_of_following',
        'number_of_tweets'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['tweets'];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function incrementTweets()
    {
        $this->number_of_tweets = $this->number_of_tweets + 1;
        $this->save();
    }

    public function incrementFollowers()
    {
        $this->number_of_followers = $this->number_of_followers + 1;
        $this->save();
    }

    public function incrementFollowing()
    {
        $this->number_of_following = $this->number_of_following + 1;
        $this->save();
    }

    public function averageTweets($countTweets)
    {
        if (count($this->tweets) == 0) {
            return 0;
        }
        $numberOfDays = Carbon::parse($this->tweets[0]->created_at)->diffInDays();
        if ($numberOfDays == 0) {
            return 0;
        }
        return $countTweets / $numberOfDays;
    }
}
