<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supply;
use App\Item;
use Illuminate\Support\Facades\Auth;
use App\Branch;
use App\User;

class SupplyItemController extends Controller
{
    public function index()
    {
        // $user = Auth::user();

        $branches = Branch::all();
        // if ($user->level_id == 1 ) {
        if (true) {
            $supplies = Supply::all();
            return view('stok.index',compact('supplies','branches'));
        }else{
            $supplies = Supply::where('branch_id',$user->employee->branch_id)->get();
            return view('stok.index',compact('supplies','branches'));

        }
    }

    public function show($id)
    {
        $supply = Supply::findOrFail($id);
        return view('stok.detail',compact('supply'));
    }

    public function create()
    {
        // $userBranch =  Auth::user()->employee->branch;
        $userBranch = User::find(2);
        $items = Item::all();
        $branch = $userBranch->employee->branch;
        return view('stok.tambah',compact('items','branch'));
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

        return redirect()->route('stok.index');
    }

    public function edit($id)
    {
        $supply = Supply::findOrFail($id);
        $items = Item::all();
        return view('stok.ubah',compact('supply','items'));
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
        return redirect()->route('stok.index');
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
        return redirect()->route('stok.index');
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
