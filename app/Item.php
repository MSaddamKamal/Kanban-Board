<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
      protected $fillable = ['title', 'description', 'order', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
