<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RenewPassport extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'id',
    //     'user_id',
    //     'name',
    //     'passport_number',
    //     'civil_id',

    //     'mailing_address',
    //     'permanent_address',
    //     'ems',
    //     'profession_file',
    //     'passport_photocopy',
    //     'kuwait_phone',
    //     'bd_phone',
    //     'special_skill',
    //     'residence',
    //     'delivery_date',
    //     'profession_id',
    //     'salary',
    //     'date',
    //     'delivery_branch',
    //     'is_delivered',


    //     'r_id',
    //     'entry_person',
    //     'remarks',
    // ];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_creator_id');
    }

    public function remarksBy()
    {
        return $this->belongsTo(User::class, 'remarks_by');
    }

    public function deletor()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
    public function deForBio()
    {
        return $this->belongsTo(User::class, 'de_id_for_bio');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_creator_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function deliveryBranch()
    {
        return $this->belongsTo(Branch::class, 'delivery_branch');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    public function passportDelivery()
    {
        return $this->hasOne(PassportDelivery::class, 'passport_id');
    }
}
