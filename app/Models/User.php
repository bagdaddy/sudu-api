<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @property Collection $pendingFriendRequests
 * @property Collection $sentFriendRequests
 * @property Collection $friends
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'username',
        'country',
        'description',
        'password',
        'is_public',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pendingFriendRequests(): HasMany
    {
        return $this->hasMany(FriendInvite::class, 'invitee_id', 'id')->where('is_pending', '=', true);
    }

    public function sentFriendRequests(): HasMany
    {
        return $this->hasMany(FriendInvite::class, 'user_id', 'id')->where('is_pending', '=', true);
    }

    public function friends(): HasMany
    {
        return $this->hasMany(Friend::class, 'user_id', 'id');
    }
}
