<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use Illuminate\Support\Facades\Auth;
class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();

        return view('cabang.index',compact('branches'));
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);
        return view('cabang.detail',compact('branch'));
    }

    public function create()
    {
        return view('cabang.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'pimpinan'=>'required',
            'kode'=>'required|min:2|max:2|regex:/^[a-zA-Z]+$/u|unique:branches',
            'provinsi'=>'required',
            'kecamatan'=>'required',
            'kota'=>'required',
        ]);

        $newBranch = Branch::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'pimpinan'=>$request->pimpinan,
            'kode'=>strtoupper($request->kode),
            'provinsi'=>$request->provinsi,
            'kecamatan'=>$request->kecamatan,
            'kota'=>$request->kota,
            'created_by'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id
        ]);

        return redirect()->route('cabang.index');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);

        return view('cabang.ubah',compact('branch'));
    }

    public function update(Request $request)
    {
        $updatedBranch = Branch::findOrFail($request->id);
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'pimpinan'=>'required',
            'kode'=>'required|min:2|max:2|regex:/^[a-zA-Z]+$/u|unique:branches,kode,'.$updatedBranch->id,
            'provinsi'=>'required',
            'kecamatan'=>'required',
            'kota'=>'required'
        ]);


        $updatedBranch->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'pimpinan'=>$request->pimpinan,
            'kode'=>strtoupper($request->kode),
            'provinsi'=>$request->provinsi,
            'kecamatan'=>$request->kecamatan,
            'kota'=>$request->kota,
            'updated_by'=>Auth::user()->id
        ]);

        return redirect()->route('cabang.index');
    }

    public function delete($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return redirect()->route('cabang.index');
    }
}
