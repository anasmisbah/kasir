<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('barang.index',compact('items'));
    }

    public function getJsonItem(Request $request)
    {
        $items = Item::findOrFail($request->id);

        return response()->json([
            'data'=>$items
        ]);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('barang.detail',compact('item'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('barang.tambah',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'harga'=>'required',
            'category_id'=>'required'
        ]);

        $newItem = Item::create([
            'nama'=>$request->nama,
            'harga'=>$request->harga,
            'category_id'=>$request->category_id
        ]);

        return redirect()->route('barang.index');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('barang.ubah',compact('item','categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'harga'=>'required',
            'category_id'=>'required'
        ]);

        $updatedItem = Item::findOrFail($request->id);

        $updatedItem->update([
            'nama'=>$request->nama,
            'harga'=>$request->harga,
            'category_id'=>$request->category_id
        ]);

        return redirect()->route('barang.index');
    }

    public function search(Request $request)
    {
        if ($request->keyword) {
            $items = Item::where('nama', 'LIKE', "%{$request->keyword}%")
                            ->get();
            return $items;
        }else{
            $items = Item::all();
            return $items;
        }
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route('barang.index');
    }


}
