<?php

namespace App\Models\tag;

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
