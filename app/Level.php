<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'nama','created_by','updated_by'
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
