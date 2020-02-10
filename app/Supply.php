<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $fillable = [
        'harga_selisih', 'harga_cabang', 'stok', 'item_id','branch_id','created_by','updated_by'
    ];

    public function item()
    {
        return $this->belongsTo('App\Item');
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
