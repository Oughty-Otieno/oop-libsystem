<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'code',
        'category_id',
        'publisher',
        'fine_amount',
        'quantity',

    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function borrowing()
    {
        return $this->hasMany('App\Models\Borrowing');
    }
}
