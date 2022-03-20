<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
// use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable,HasRoles,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // use SoftDeletes;
    protected $fillable = [
        'registerdate',
        'name', 'profile','email', 'password','phone','address','status'
    ];
    public function orders(){
            return $this->hasMany('App\Order');
        }

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
}
