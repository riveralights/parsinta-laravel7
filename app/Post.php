<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'category_id'];

    // satu postingan memiliki satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // satu postingan punya banyak tag, satu tag punya banyak postingan
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
