<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function beranda(){

        if (auth()->user()->level_id == 3) {
            return redirect()->route('kasir.index');
        }
        return view('layouts.master');
    }
}
