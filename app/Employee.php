<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nama', 'jenis_kelamin', 'jabatan','alamat','telepon','foto','branch_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
