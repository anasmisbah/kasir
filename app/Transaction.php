<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'kuantitas', 'total_harga', 'no_urut', 'supply_id','created_by','updated_by'
    ];

    public function bill()
    {
        return $this->belongsTo('App\Bill');
    }

    public function supply()
    {
        return $this->belongsTo('App\Supply');
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
