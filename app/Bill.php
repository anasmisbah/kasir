<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'tanggal_nota', 'diskon', 'total_nota','jumlah_uang_nota','kembalian_nota','status','user_id','customer_id','no_nota_kas','branch_id','created_by','updated_by'
    ];

    protected $dates = [
        'tanggal_nota'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction');
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
