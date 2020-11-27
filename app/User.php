<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            // Create default categories
            $user->categories()->createMany([
                [
                    'title' => 'Default Col1',
                    'slug' => 'default-col1',
                    'order' => 1
                ],
                [
                    'title' => 'Default Col2',
                    'slug' => 'default-col2',
                    'order' => 2
                ],
                 [
                    'title' => 'Default Col3',
                    'slug' => 'default-col3',
                    'order' => 6
                ],
           
            ]);
       

        });


    }

    public function items()
    {
        return $this->hasMany(Item::class)->orderBy('order');
    }

    public function categories()
    {
        return $this->hasMany(Category::class)->orderBy('order');
    }
}
