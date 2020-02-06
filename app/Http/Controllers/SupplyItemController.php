<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supply;
use App\Item;
use Illuminate\Support\Facades\Auth;
use App\Branch;
use App\User;
use App\APPlication;
use Carbon\Carbon;
use PDF;
class SupplyItemController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $branches = Branch::all();
        $app = Application::first();
        $branch = $user->employee->branch;
        if ($user->level_id == 1 ) {
            if ($request) {
                if ($request->filter === "cabang") {
                    if($request->cabang === "0"){
                        $supplies = Supply::all();
                    }else{
                        $supplies = Supply::where('branch_id',$request->cabang)->get();
                        $branch = Branch::findOrFail($request->cabang);
                    }
                }else{
                    $supplies = Supply::all();
                }
                if ($request->pdf) {
                    $data = [
                        'supplies'=>$supplies,
                        'branch'=> $branch,
                        'app'=>$app,
                        'date'=>Carbon::now()->format('d F Y')
                    ];
                    $pdf = PDF::loadView('pdf.stok', $data);
                    // return $pdf->stream();
                    return $pdf->download('stok.pdf');
                }
            }else{
                $supplies = Supply::all();
            }
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

    public function getJsonSupply(Request $request)
    {
        $supply = Supply::findOrFail($request->id);

        return response()->json([
            'supply'=>$supply
        ]);
    }

    public function create()
    {
        $userBranch =  Auth::user()->employee->branch;
        $items = Item::all();
        $branch = $userBranch;
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
