<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();

        return $branches;
    }

    public function show($id)
    {
        $branch = Branch::findOrFail($id);

        return $branch;
    }

    public function create()
    {
        // TODO return view()
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required',
            'pimpinan'=>'required',
        ]);

        $newBranch = Branch::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'pimpinan'=>$request->pimpinan,
        ]);

        return $newBranch;
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);

        return $branch;
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required',
            'pimpinan'=>'required',
        ]);

        $updatedBranch = Branch::findOrFail($request->id);

        $updatedBranch->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'pimpinan'=>$request->pimpinan,
        ]);

        return $updatedBranch;
    }

    public function search(Request $request)
    {
        if ($request->keyword) {
            $categories = Branch::where('nama', 'LIKE', "%{$request->keyword}%")->get();
                            // ->orWhere('alamat', 'LIKE', "%{$request->keyword}%")
                            // ->orWhere('telepon', 'LIKE', "%{$request->keyword}%")
                            // ->orWhere('pimpinan', 'LIKE', "%{$request->keyword}%")

            return $categories;
        }else{
            $categories = Branch::all();
            return $categories;
        }
    }

    public function delete($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return true;
    }
}
