<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'nama'
    ];

    public function item()
    {
        return $this->hasMany('App\Item');
    }
}
