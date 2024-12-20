<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'post_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'user_id');
    }
    public function categoryname()
    {
        return $this->belongsTo(Category::class, 'category', 'category_id');
    }
}
