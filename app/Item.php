<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'nama', 'harga','category_id'
    ];

    public function supply()
    {
        return $this->hasMany('App\Supply');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
