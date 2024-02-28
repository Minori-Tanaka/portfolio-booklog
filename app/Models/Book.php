<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use HasFactory;

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bookmarks() {
        return $this->hasMany(Bookmark::class);
    }

    public function isBookmarked() {
        return $this->bookmarks()->where('user_id', Auth::user()->id)->exists();
    }

    public function categoryBook() {
        return $this->hasMany(CategoryBook::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class)->latest();
    }
 }
