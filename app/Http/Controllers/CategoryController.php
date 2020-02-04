<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

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
            'nama'=>'required'
        ]);

        $newCategory = Category::create([
            'nama'=>$request->nama
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
        $request->validate([
            'nama'=>'required'
        ]);
        $updatedCategory = Category::findOrFail($request->id);
        $updatedCategory->update([
            'nama'=>$request->nama
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
