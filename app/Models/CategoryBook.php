<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBook extends Model
{
    use HasFactory;

    protected $table = 'category_book';
    protected $fillable = ['book_id', 'category_id', 'user_id'];

    public $timestamps = false;

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
