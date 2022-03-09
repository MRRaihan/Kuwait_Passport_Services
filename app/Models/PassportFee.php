<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type',
        'title',
        'government_fee',
        'versatilo_fee',
        'status',
    ];
}
