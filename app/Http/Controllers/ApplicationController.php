<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {

    }

    public function detail()
    {
        $app = Application::first();

        return $app;
    }

    public function store(Request $request)
    {
        $request->validate([

        ]);

        $foto='';
        if ($request->file('foto')) {
            $foto = $request->file('foto')->store('fotos','public');
        }
        $store = Application::create([
            'nama'=>$request->nama,
            'toko'=>$request->toko,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'foto'=>$foto
        ]);



        return $store;
    }

    public function update(Request $request)
    {
        $request->validate([

        ]);

        $app = Application::findOrFail($request->id);

        $update = $app->update([
            'nama'=>$request->nama,
            'toko'=>$request->toko,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon
        ]);

        if ($request->file('foto')) {
            if ($update->foto && file_exists(storage_path('app/public/'.$update->foto))) {
                Storage::delete('public/'.$update->foto);
            }
            $update->update([
                'foto'=> $request->file('foto')->store('fotos','public')
            ]);
        }

        return $update;
    }
}
