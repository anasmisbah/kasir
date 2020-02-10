<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'nama', 'harga','category_id','created_by','updated_by'
    ];

    public function supply()
    {
        return $this->hasMany('App\Supply');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by','id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by','id');
    }
}
