<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'telepon','pimpinan'
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
}
