<?php

namespace App\Models\tag;

use App\Models\post\Post;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'taggable_id',
    ];

    public function taggable()
    {
        return $this->morphTo();
    }
}
