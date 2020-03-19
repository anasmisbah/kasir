<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('jenis.index',compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('jenis.detail',compact('category'));
    }

    public function create()
    {
        return view('jenis.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'kode'=>'required|min:2|max:2|regex:/^[a-zA-Z]+$/u|unique:categories'
        ]);

        $newCategory = Category::create([
            'nama'=>$request->nama,
            'kode'=>strtoupper($request->kode),
            'created_by'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id
        ]);

        return redirect()->route('jenis.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('jenis.ubah',compact('category'));
    }

    public function update(Request $request)
    {
        $updatedCategory = Category::findOrFail($request->id);
        $request->validate([
            'nama'=>'required',
            'kode'=>'required|min:2|max:2|regex:/^[a-zA-Z]+$/u|unique:categories,kode,'.$updatedCategory->id
        ]);
        $updatedCategory->update([
            'nama'=>$request->nama,
            'kode'=>strtoupper($request->kode),
            'updated_by'=>Auth::user()->id
        ]);
        return redirect()->route('jenis.index');
    }

    public function search(Request $request)
    {
        if ($request->keyword) {
            $categories = Category::where('nama', 'LIKE', "%{$request->keyword}%")->get();
            return $categories;
        }else{
            $categories = Category::all();
            return $categories;
        }
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('jenis.index');
    }


}
