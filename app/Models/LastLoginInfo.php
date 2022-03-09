<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastLoginInfo extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'id',
    //     'user_id',
    //     'session_data',
    //     'machine_ip',
    //     'user_agent',
    //     'agent_string',
    //     'platform',
    //     'creadted_dtm',
    // ];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
