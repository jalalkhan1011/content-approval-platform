<?php

namespace App\Models\post;

use App\Models\category\Category;
use App\Models\tag\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable  = [
        'user_id',
        'title',
        'description',
        'status',
        'iamge_path',
        'thumbnail_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }
}
