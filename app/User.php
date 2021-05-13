<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRolesAndPermissions;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions; // Наш новый трейт
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_topic'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function contact()
    {
        return $this->hasMany('App\User', 'id');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment', 'id');
    }


    /**
     * The user topic sending time limit.
     *
     * @var integer
     */
    protected $limitInHours = 24;

    /**
     * Get the user last topic create time.
     *
     * @return string
     */
    public function getLastTopicTime()
    {
        return $this->last_topic ?? false;
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the user topic send enable formatted time.
     *
     * @param string $format
     * @return string
     * @throws Exception
     */
    public function getTopicSendEnableTime($format = 'H:i d.m.Y')
    {
        if (! $this->getLastTopicTime())
            return false;

        $time = new Carbon($this->getLastTopicTime());
        $time = $time->addHours($this->limitInHours)->format($format);

        return $time;
    }

    /**
     * Determines the user can send topic message.
     *
     * @return bool
     */
    public function canSend()
    {
        if(! $this->getLastTopicTime())
            return true;

        $hours = Carbon::now()->diffInHours($this->getLastTopicTime());

        return $hours >= $this->limitInHours ? true : false;
    }

    /**
     * Update the user last topic time.
     *
     * @param string $format
     * @return void
     */
    public function updateLastTopic($format = 'Y-m-d H:i:s')
    {
        $this->update([
            'last_topic' => Carbon::now()->format($format)
        ]);
    }
}
