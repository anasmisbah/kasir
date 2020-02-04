<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'kuantitas', 'total_harga', 'no_urut', 'supply_id'
    ];

    public function bill()
    {
        return $this->belongsTo('App\Bill');
    }

    public function supply()
    {
        return $this->belongsTo('App\Supply');
    }
}
