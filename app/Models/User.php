<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'bio',
        'password',
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendship', 'user_id', 'friend_id')
            ->wherePivot('status', 'accepted')
            ->orWhere(function ($query) {
                $query->where('friendship.friend_id', $this->id)
                      ->where('friendship.user_id', '!=', $this->id)
                      ->where('friendship.status', 'accepted');
            });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'user_id');
    }
}
