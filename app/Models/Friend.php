<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Friend extends Model
{
    protected $fillable = [
        'user_id',
        'friend_id',
    ];

    use HasFactory;

    public function friend(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'friend_id');
    }
}
