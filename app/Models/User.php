<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\post;
use Laravel\Sanctum\HasApiTokens;
use App\Permissions\HasPermissionsTrait;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'address',
        'phone',
        'added_by',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany('App\Models\post');
    }
    public function farmer()
    {
        return $this->hasMany('App\Models\Farmer');
    }
    public function group()
    {
        return $this->hasMany('App\Models\Group');
    }
    public function land()
    {
        return $this->hasMany('App\Models\FarmLand');
    }
    public function supply()
    {
        return $this->hasMany('App\Models\Supply');
    }
    public function unit()
    {
        return $this->hasMany('App\Models\Unit');
    }
    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }
    public function orders()
    {
        return $this->hasMany('App\Models\order');
    }
    public function Warehouse()
    {
        return $this->hasMany('App\Models\Warehouse','id');
    }
    

    use HasPermissionsTrait; //Import The Trait
}
