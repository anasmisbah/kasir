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
        $app = Application::first();

        return view('tentang.index',compact('app'));
    }

    public function edit()
    {
        $app = Application::first();

        return view('tentang.edit',compact('app'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'toko'=>'required',
            'alamat'=>'required',
            'telepon'=>'required',
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


        return redirect()->route('tentang.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'toko'=>'required',
            'alamat'=>'required',
            'telepon'=>'required',
        ]);

        $app = Application::findOrFail($request->id);

        $app->update([
            'nama'=>$request->nama,
            'toko'=>$request->toko,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'updated_by'=>Auth::user()->id
        ]);

        if ($request->file('logo')) {
            $request->validate([
                'logo'=>'mimes:jpeg,bmp,png,jpg,ico',
            ]);
            if (!($app->logo == "logo/default.jpg") && file_exists(storage_path('app/public/'.$app->logo))) {
                Storage::delete('public/'.$app->logo);
            }
            $app->update([
                'logo'=> $request->file('logo')->store('logo','public')
            ]);
        }

        return redirect()->route('tentang.index');
    }
}
