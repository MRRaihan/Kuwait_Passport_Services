<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    // protected $fillable = [
    //     'id',
    //     'name',
    //     'phone',
    //     'email',
    //     'parent_id',
    //     'created_by',
    //     'created_dtm',
    //     'updated_by',
    //     'updated_dtm',
    //     'ems',
    //     'status',
    //     'user_type',
    //     'password',
    // ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function manualPassport()
    {
        return $this->hasOne(ManualPassport::class, 'user_creator_id');
    }

    public function lostPassport()
    {
        return $this->hasOne(LostPassport::class, 'user_creator_id');
    }

    public function extendingPassport()
    {
        return $this->hasOne(ExtendingPassport::class, 'user_id');
    }

    public function other()
    {
        return $this->hasOne(Other::class, 'user_creator_id');
    }

    public function lastLoginInfo()
    {
        return $this->hasOne(LastLoginInfo::class, 'user_id');
    }
}
