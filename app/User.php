<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class,'user_id','id');
    }

    public function account()
    {
        return $this->hasOne(UserAccount::class, 'user_id', 'id');
    }

    public function accounts()
    {
        return $this->hasMany(UserAccount::class, 'user_id', 'id');
    }




}