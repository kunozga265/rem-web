<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function error()
    {
        return $this->hasOne("App\Models\Error","code","error_code");
    }

    protected $fillable=[
        'status',
        'error_code',
        'start_time',
        'end_time',
    ];
}