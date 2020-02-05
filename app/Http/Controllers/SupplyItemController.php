<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supply;
use App\Item;

class SupplyItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $branches = Branch::all();
        if ($user->level_id == 1 ) {
            $supplies = Supply::all();
            return $supplies;
        }else{
            $supplies = Supply::where('branch_id',$user->employee->branch_id)->get();
            return $supplies;
        }

    }

    public function show($id)
    {
        $user = Supply::findOrFail($id);
        return $user;
    }

    public function create()
    {
        $items = Item::all();
        $branch = Auth::user()->employee->branch;
        // TODO return view()
    }

    public function store(Request $request)
    {
        $request->validate([
            'harga_selisih' => 'required',
            'harga_cabang'=>'required',
            'stok'=>'required',
            'item_id'=>'required',
            'branch_id'=>'required',
        ]);

        $newSupplyItem = Supply::create([
            'harga_selisih' => $request->harga_selisih,
            'harga_cabang'=>$request->harga_cabang,
            'stok'=>$request->stok,
            'item_id'=>$request->item_id,
            'branch_id'=>$request->branch_id,
        ]);

        return $newSupplyItem;
    }

    public function edit($id)
    {
        $supply = Supply::findOrFail($id);
        $items = Item::all();
        $branch = Auth::user()->employee->branch;
        return $supply;
    }

    public function update(Request $request)
    {
        $request->validate([
            'harga_selisih' => 'required',
            'harga_cabang'=>'required',
            'stok'=>'required',
            'item_id'=>'required',
            'branch_id'=>'required',
        ]);
        $updatedSupplyItem = Supply::findOrFail($request->id);
        $updatedSupplyItem->update([
            'harga_selisih' => $request->harga_selisih,
            'harga_cabang'=>$request->harga_cabang,
            'stok'=>$request->stok,
            'item_id'=>$request->item_id,
            'branch_id'=>$request->branch_id,
        ]);
        return $updatedSupplyItem;
    }

    public function search(Request $request)
    {
        if ($request->keyword) {
            $supplies = Supply::with('items')->where('items.nama', 'LIKE', "%{$request->keyword}%")->get();
            return $supplies;
        }else{
            $supplies = Supply::all();
            return $supplies;
        }
    }

    public function delete($id)
    {
        $supply = Supply::findOrFail($id);
        $supply->delete();
        return true;
    }

    public function filter(Request $request)
    {
        if ($request->filter === "cabang") {
            if($request->cabang === 0){
                $supplies = Supply::all();
                return $supplies;
            }else{
                $supplies = Supply::where('branch_id',$request->cabang)->get();
                return $supplies;
            }
        }else{
            $supplies = Supply::all();
            return $supplies;
        }
    }
}
