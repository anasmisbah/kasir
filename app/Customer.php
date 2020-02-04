<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'telepon','branch_id'
    ];

    public function bill()
    {
        return $this->hasMany('App\Bill');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
