<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{

    public const REAL = 1;
    public const IG_GOLD = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function profile() {
        return $this->hasOne(Profile::class, 'user_id', 'user_id');
    }



}