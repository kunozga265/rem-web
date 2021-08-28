<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function fault()
    {
        return $this->hasOne("App\Models\Fault","code","fault_code");
    }

    protected $fillable=[
        'status',
        'fault_code',
        'start_time',
        'end_time',
    ];
}
