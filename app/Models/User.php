<?php

namespace App\Models;

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

    public function renewPassports()
    {
        return $this->hasMany(RenewPassport::class, 'user_creator_id');
    }
    public function manualPassports()
    {
        return $this->hasMany(ManualPassport::class, 'user_creator_id');
    }
    public function lostPassports()
    {
        return $this->hasMany(LostPassport::class, 'user_creator_id');
    }
    public function newBornBabyPassports()
    {
        return $this->hasMany(NewBornBabyPassport::class, 'user_creator_id');
    }

    public function dataEnterersUnderMe(){
        return $this->hasMany(User::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(User::class, 'parent_id');
    }
}
