<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Branch;
use App\Customer;
use App\Bill;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::all();
        $tanggal = Bill::get()->groupBy(function ($val) {
            return Carbon::parse($val->date)->toDateString();
        });

        $bulan = Bill::get()->groupBy(function ($val) {
            return Carbon::parse($val->date)->localeMonth;
        });
        $tahun = Bill::get()->groupBy(function ($val) {
            return Carbon::parse($val->date)->year;
        });

        $branches = Branch::all();

        return $bills;
    }

    public function show($id)
    {
        $bill = Bill::findOrFail($id);

        return $bill;
    }

    public function create()
    {
        $customers = Auth::user()->employee->branch->customer;
        // TODO return view()
    }

    public function search($key)
    {
        # code...
    }

    public function delete($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();
        return true;
    }

    public function filter(Request $request)
    {
        $bills = null;
        if ($request->filter === "hari") {
            $bills = Bill::where('tanggal_nota',$request->hari)->get();
        }else if($request->filter === "bulan"){
            $bills = Bill::whereMonth('tanggal_nota',$request->bulan)
                            ->whereYear('tanggal_nota',$request->tahun)
                            ->orderBy('tanggal_nota', 'asc')
                            ->get();
        }else if($request->filter === "tahun"){
            $bills = Bill::whereYear('tanggal_nota',$request->tahun)
                            ->orderBy('tanggal_nota', 'asc')
                            ->get();

        }else if($request->filter === "cabang"){
            if ($request->cabang === 0) {
                $bills = Bill::all();
            }else{
                $bills = Bill::with('user','employee','branch')->where('employee.branch_id',$request->cabang)->get();
            }
        }else if($request->filter === "status"){
            if ($request->cabang === 0) {
                $bills = Bill::all();
            }else{
                $bills = Bill::where('status',$request->status)->get();
            }
        }else{
            $bills = Bill::all();
        }

        
    }

    public function pdf(Request $request)
    {

    }

    //menu Piutang
    public function piutangAll()
    {
        $billsPiutang = Bill::where('status','piutang')->get();

        return $billsPiutang;
    }

    public function piutangFilter(Request $request)
    {
        if ($request->filter == "tanggal") {
            $bills = Bill::where('tanggal_nota',$request->tanggal)->get();

            return $bills;
        }else if($request->filter === "cabang"){
            if ($request->branch === "semua") {
                $bills = Bill::all();
                return $bills;
            }else{
                $bills = Bill::with('user','employee','branch')->where('employee.branch_id',$request->branch_id)->get();
                return $bills;
            }
        }
    }

    public function showPiutang($id)
    {
        $bill = Bill::findOrFail($id);

    }


    //Menu Kasir
    public function kasir()
    {
        $customers = Auth::user()->employee->branch->customer;
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'user_id'=>'required',
            'tanggal_nota'=>'required',
            'diskon'=>'required',
            'total_nota'=>'required',
            'jumlah_uang_nota'=>'required',
            'kembalian_nota'=>'required',
            'status'=>'required',
            'customer_id'=>'required'
        ]);

        // TODO no_nota_kas
        $newBill = Bill::create([
            'user_id'=>$user->id,
            'tanggal_nota'=>$request->tanggal_nota,
            'diskon'=>$request->diskon,
            'total_nota'=>$request->total_nota,
            'jumlah_uang_nota'=>$request->jumlah_uang_nota,
            'kembalian_nota'=>$request->kembalian_nota,
            'status'=>$request->status,
            'branch_id'=>$user->employee->branch_id,
            'customer_id'=>$request->customer_id
        ]);

        $transaksi = [
            [
                'total_harga'=>60000,
                'kuantitas'=>100,
                'supply_id'=>1
            ],
            [
                'total_harga'=>60000,
                'kuantitas'=>100,
                'supply_id'=>1
            ],
            [
                'total_harga'=>60000,
                'kuantitas'=>100,
                'supply_id'=>1
            ],
            [
                'total_harga'=>60000,
                'kuantitas'=>100,
                'supply_id'=>1
            ],
        ];

        foreach ($transaksi as $key => $item) {
            $newBill->transaksi()->create([
                'no_urut'=>$key,
                'total_harga'=>$item->total_harga,
                'kuantitas'=>$item->kuantitas,
                'supply_id'=>$item->supply_id
            ]);
        }

        return $newBill;
    }
}
