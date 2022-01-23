<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @propertu string $body
 * @property PooPin $pooPin
 * @property User $user
 * @property Collection $likes
 * @property Collection $comments
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($post) {
            $post->pooPin()->delete();
            $post->comments()->delete();
            $post->likes()->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pooPin(): HasOne
    {
        return $this->hasOne(PooPin::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
