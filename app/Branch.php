<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'telepon','pimpinan','created_by','updated_by','kode','provinsi','kecamatan','kota'
    ];

    public function supply()
    {
        return $this->hasMany('App\Supply');
    }

    public function employee()
    {
        return $this->hasMany('App\Employee');
    }

    public function customer()
    {
        return $this->hasMany('App\Customer');
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
