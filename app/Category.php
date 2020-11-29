<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    // setiap kategori pasti memiliki banyak post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
