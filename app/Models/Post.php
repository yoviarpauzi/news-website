<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "users_id",
        'thumbnail',
        'title',
        'slug',
        'content',
        'view_count',
        'status',
        'published_at'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function category_posts(): HasMany
    {
        return $this->hasMany(CategoryPost::class, 'posts_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts', 'posts_id', 'categories_id');
    }
}
