<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Other extends Model
{
    use HasFactory, SoftDeletes;

    // protected $fillable = [
    //     'id',
    //     'user_id',
    //     'name',
    //     'passport_number',
    //     'profession_id',
    //     'civil_id',

    //     'passport_photocopy',
    //     'profession_file',
    //     'mailing_address',
    //     'kuwait_phone',
    //     'permanent_address',
    //     'bd_phone',
    //     'special_skill',
    //     'residence',
    //     'salary',
    //     'remarks',
    //     'ems',
    //     'date',
    //     'delivery_date',
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
}
