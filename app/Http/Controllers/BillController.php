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
    public function index(Request $request)
    {
        $branches = Branch::all();
        $user = Auth::user();

        if ($user->level_id == 1) {
            if ($request->filter === "hari") {

                $explodedate = explode('/',$request->hari);
                $date = $explodedate[2]."-".$explodedate[0]."-".$explodedate[1];

                $bills = Bill::whereDate('tanggal_nota',$date)->get();
            }else if($request->filter === "bulan"){
                $bills = Bill::whereMonth('tanggal_nota',$request->bulan)
                                ->whereYear('tanggal_nota',$request->bulantahun)
                                ->orderBy('tanggal_nota', 'asc')
                                ->get();
            }else if($request->filter === "tahun"){
                $bills = Bill::whereYear('tanggal_nota',$request->tahun)
                                ->orderBy('tanggal_nota', 'asc')
                                ->get();

            }else if($request->filter === "cabang"){
                if ($request->cabang === "0") {
                    $bills = Bill::all();
                }else{
                    $bills = Bill::where('branch_id',$request->cabang)->get();
                }
            }else{
                $bills = Bill::all();
            }
        }else{
            if ($request->filter === "hari") {
                $explodedate = explode('/',$request->hari);
                $date = $explodedate[2]."-".$explodedate[0]."-".$explodedate[1];
                $bills = Bill::where('branch_id',$user->employee->branch_id)
                            ->whereDate('tanggal_nota',$date)
                            ->get();
            }else if($request->filter === "bulan"){
                $bills = Bill::where('branch_id',$user->employee->branch_id)
                                ->whereMonth('tanggal_nota',$request->bulan)
                                ->whereYear('tanggal_nota',$request->bulantahun)
                                ->orderBy('tanggal_nota', 'asc')
                                ->get();
            }else if($request->filter === "tahun"){
                $bills = Bill::where('branch_id',$user->employee->branch_id)
                                ->whereYear('tanggal_nota',$request->tahun)
                                ->orderBy('tanggal_nota', 'asc')
                                ->get();

            }else if($request->filter === "status"){
                if ($request->status === "0") {
                    $bills = Bill::where('branch_id',$user->employee->branch_id)->get();
                }else{
                    $bills = Bill::where([
                            ['status','=',$request->status],
                            ['branch_id','=',$user->employee->branch_id]
                        ])->get();
                }
            }else{
                $bills = Bill::where('branch_id',$user->employee->branch_id)->get();
            }
        }

        $billForDate = Bill::all();
        $tanggal=[];
        $bulan = [];
        $tahun =[];
        foreach ($billForDate as $key => $bill) {
            $tanggal[$bill->tanggal_nota->format('Y-m-d')] = $bill->tanggal_nota->format('Y-m-d');
            $bulan[$bill->tanggal_nota->month] =$bill->tanggal_nota->localeMonth;
            $tahun[$bill->tanggal_nota->year] =$bill->tanggal_nota->year;
        }


        return view('penjualan.index',compact('bills','branches','bulan','tahun'));
    }

    public function show($id)
    {
        $bill = Bill::findOrFail($id);

        return view('penjualan.detail',compact('bill'));
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



    }

    public function pdf(Request $request)
    {

    }

    //menu Piutang
    public function piutangAll(Request $request)
    {
        $bills = Bill::where('status','piutang')->get();
        $branches = Branch::all();
        $user = Auth::user();
        if ($user->level_id == 1) {
            if ($request->filter === "hari") {

                $explodedate = explode('/',$request->hari);
                $date = $explodedate[2]."-".$explodedate[0]."-".$explodedate[1];

                $bills = Bill::whereDate('tanggal_nota',$date)->where('status','piutang')->get();
            }else if($request->filter === "cabang"){
                if ($request->cabang === "0") {
                    $bills = Bill::where('status','piutang')->get();
                }else{
                    $bills = Bill::where([
                        ['branch_id','=',$request->cabang],
                        ['status','=','piutang']
                        ])->get();
                }
            }else{
                $bills = Bill::where('status','piutang')->get();
            }
        }else{
            if ($request->filter === "hari") {
                $explodedate = explode('/',$request->hari);
                $date = $explodedate[2]."-".$explodedate[0]."-".$explodedate[1];
                $bills = Bill::where([
                    ['branch_id','=',$user->employee->branch_id],
                    ['status','=','piutang']
                    ])
                            ->whereDate('tanggal_nota',$date)
                            ->get();
            }else{
                $bills = Bill::where([
                    ['branch_id','=',$user->employee->branch_id],
                    ['status','=','piutang']
                    ])->get();
            }
        }

        return view('piutang.index',compact('bills','branches'));
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

        return view('piutang.detail',compact('bill'));

    }


    //Menu Kasir
    public function kasir()
    {
        $branch = Auth::user()->employee->branch;
        $customers = $branch->customer;
        $supplies = $branch->supply;
        $date = Carbon::now();
        $lastBill = Bill::select('id')->orderBy('id','desc')->first();
        if (!$lastBill) {
            $formatnnk = $branch->id."". Auth::user()->employee->id ."0".$date->day."".$date->month."".$date->year;

        }else{

            $formatnnk = $branch->id."". Auth::user()->employee->id."" .($lastBill->id+1)."".$date->day."".$date->month."".$date->year;
        }

        return view('kasir.index',compact('branch','customers','supplies','formatnnk'));
    }

    public function saveBillAjax(Request $request)
    {
        $user = Auth::user();
        $tanggal_nota = Carbon::now();
        $newBill = Bill::create([
            'user_id'=>$user->id,
            'tanggal_nota'=>$tanggal_nota,
            'diskon'=>$request->data['diskon'],
            'total_nota'=>$request->data['total_nota'],
            'jumlah_uang_nota'=>$request->data['jumlah_uang_nota'],
            'kembalian_nota'=>$request->data['kembalian_nota'],
            'status'=>strtolower($request->data['status']),
            'branch_id'=>$user->employee->branch_id,
            'customer_id'=>$request->data['customer_id'],
            'no_nota_kas'=>$request->data['no_nota_kas']
        ]);

        foreach ($request->data['items'] as $key => $item) {
            $newBill->transaction()->create([
                'no_urut'=>$item['no_urut'],
                'total_harga'=>$item['total_harga'],
                'kuantitas'=>$item['kuantitas'],
                'supply_id'=>$item['supply_id']
            ]);
        }

        return response()->json([
            'data'=>$newBill,
            'status'=>true
        ]);
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
