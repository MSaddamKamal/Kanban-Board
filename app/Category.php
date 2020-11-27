<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
      protected $fillable = ['title', 'slug', 'order'];

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(Item::class)->orderBy('order');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
