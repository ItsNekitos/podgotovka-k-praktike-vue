<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'place_name',
        'event',
        'date',
        'oplata',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
