<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'telepon','branch_id','created_by','updated_by'
    ];

    public function bill()
    {
        return $this->hasMany('App\Bill');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
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
