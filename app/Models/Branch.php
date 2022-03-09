<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'status',
    ];

    public function lostPassport()
    {
        return $this->hasOne(LostPassport::class, 'delivery_branch');
    }
}
