<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryPost extends Model
{
    use HasFactory;

    protected $primaryKey = ["categories_id", "posts_id"];

    protected $fillable = [
        "categories_id",
        'posts_id'
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function posts(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'posts_id', 'id');
    }
}
