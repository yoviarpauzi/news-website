<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function category_posts(): HasMany
    {
        return $this->hasMany(CategoryPost::class, 'categories_id', 'id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_posts', 'categories_id', 'posts_id');
    }
}
