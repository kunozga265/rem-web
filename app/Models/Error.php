<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    use HasFactory;

    public function events()
    {
        return $this->belongsTo("App\Models\Event");
    }

    protected $fillable=[
        "code",
        "name",
        "causes",
        "solution",
    ];
}
