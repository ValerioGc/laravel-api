<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts() {
        return $this->hasMany('App\Post');
    }
    protected $fillable = ['title', 'slug', 'category_id'];
}
