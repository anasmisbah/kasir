<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;
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
            'kelurahan'=>'required',
            'kecamatan'=>'required',
            'kota'=>'required'
        ]);

        $app = Application::findOrFail($request->id);

        $app->update([
            'nama'=>$request->nama,
            'toko'=>$request->toko,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'kelurahan'=>$request->kelurahan,
            'kecamatan'=>$request->kecamatan,
            'kota'=>$request->kota,
            'updated_by'=>Auth::user()->id
        ]);
        if ($request->file('logo')) {
            $request->validate([
                'logo'=>'mimes:jpeg,bmp,png,jpg,ico',
            ]);
            if (!($app->logo == "logos/default.jpg") && file_exists('uploads/'.$app->logo)) {
                File::delete('uploads/'.$app->logo);
            }
            $logo = 'logos/'.time().Str::slug($request->nama).'.'.$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move('uploads/logos', $logo);

            $app->update([
                'logo'=> $logo
            ]);
        }

        return redirect()->route('tentang.index');
    }
}
