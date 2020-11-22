<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body'];

    // satu postingan memiliki satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
