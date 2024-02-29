<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'book_id', 'book_id');
    }
    
    public function isReviewed($user_id) {
        return $this->reviews()->where('user_id', $user_id)->exists();
    }
}
