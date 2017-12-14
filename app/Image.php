<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function category()
    {
        return $this->belongsTo('App\CategoryImage', 'category_id', 'id');
    }
}
