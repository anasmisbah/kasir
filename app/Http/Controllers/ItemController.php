<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Application;

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
            'category_id'=>$request->category_id,
            'created_by'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id,
        ]);

        $category = Category::findOrFail($request->category_id);
        $kode = $category->kode.''.str_pad(($newItem->id),2,'0',STR_PAD_LEFT);
        $newItem->kode = $kode;
        $newItem->save();
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

        if ($request->category_id != $updatedItem->category_id) {
            $category = Category::findOrFail($request->category_id);
            $kode = $category->kode.''.str_pad(($updatedItem->id),2,'0',STR_PAD_LEFT);
            $updatedItem->update([
                'kode'=>$kode,
            ]);
        }

        $updatedItem->update([
            'nama'=>$request->nama,
            'harga'=>$request->harga,
            'category_id'=>$request->category_id,
            'updated_by'=>Auth::user()->id,
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

    public function print()
    {
        $items = Item::all();
        $dateNow = Carbon::now();
        $user = Auth::user();
        $app = Application::first();
        return view('print.barang',compact('items','dateNow','user','app'));
    }


}
