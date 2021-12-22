<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, array>
     */
    protected $fillable = [
        'title',
        'description',
        'categories',
    ];

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'posts_categories',
            'post_id',
            'category_id');
    }
}
