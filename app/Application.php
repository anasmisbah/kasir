<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'nama', 'toko', 'alamat', 'telepon','logo','created_by','updated_by','provinsi','kecamatan','kota'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by','id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by','id');
    }
}
