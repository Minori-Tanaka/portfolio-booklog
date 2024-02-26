<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

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
        'password' => 'hashed',
    ];

    public function books() {
        return $this->hasMany(Book::class);
    }

    public function bookmarks() {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    public function followers() {
        return $this->hasMany(Follow::class, 'following_id');
    }

    public function following() {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function isFollowed() {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }
}
