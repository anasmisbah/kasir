<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $fillable = [
        'harga_selisih', 'harga_cabang', 'stok', 'item_id','branch_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
