<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PassportDelivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function passport()
    {
        // if($this->){

        // }
        // return $this->belongsTo(LostPassport::class, 'passport_id');
        // return $this->type_id;
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class, 'delivery_id');
    }


}
