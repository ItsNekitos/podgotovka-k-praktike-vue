<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'place_id',
        'name',
        'event',
        'date',
        'oplata',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
