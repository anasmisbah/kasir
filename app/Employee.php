<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nama', 'jenis_kelamin', 'jabatan','alamat','telepon','foto','branch_id','created_by','updated_by'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
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
