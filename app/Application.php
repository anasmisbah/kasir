<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'nama', 'toko', 'alamat', 'telepon','logo'
    ];
}
