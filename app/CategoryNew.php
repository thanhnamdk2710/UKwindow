<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryNew extends Model
{
    public function news()
    {
        return $this->hasMany('App\News', 'category_id', 'id');
    }
}
