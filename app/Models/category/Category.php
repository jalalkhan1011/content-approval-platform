<?php

namespace App\Models\category;

use App\Models\post\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
