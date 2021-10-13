<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $maximum_capacity = 100;

    protected $fillable = [
        'user_id',
        'date',
        'token',
    ];

    public function userspace()
    {
        return $this->belongsTo('App\Models\User');
    }
}
