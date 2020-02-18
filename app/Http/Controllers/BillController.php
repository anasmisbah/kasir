<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Branch;
use App\Customer;
use App\Bill;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Application;
use App\Supply;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::all();
        $user = Auth::user();
        $app = Application::first();
        $branch = $user->employee->branch;
        $filter = '';
        $billForDate = Bill::all();
        $tanggal=[];
        $bulan = [];
        $tahun =[];
        $dateNow = Carbon::now()->format('d F Y');
        foreach ($billForDate as $key => $bill) {
            $tanggal[$bill->tanggal_nota->format('Y-m-d')] = $bill->tanggal_nota->format('Y-m-d');
            $bulan[$bill->tanggal_nota->month] =$bill->tanggal_nota->localeMonth;
            $tahun[$bill->tanggal_nota->year] =$bill->tanggal_nota->year;
        }
        if ($user->level_id == 1) {
            if ($request) {
                if ($request->filter === "hari") {

                    $explodedatetime = explode(' ',$request->hari);
                    $explodeddateFrom = explode('/',$explodedatetime[0]);
                    $explodeddateTo = explode('/',$explodedatetime[3]);
                    $dateFrom = $explodeddateFrom[2]."-".$explodeddateFrom[0]."-".$explodeddateFrom[1]." ".$explodedatetime[1];
                    $dateTo =  $explodeddateTo[2]."-".$explodeddateTo[0]."-".$explodeddateTo[1]." ".$explodedatetime[4];
                    if ($request->filter2 === "cabang") {
                        if ($request->cabang == "0") {
                            $bills = Bill::whereBetween('tanggal_nota',[$dateFrom,$dateTo])->get();
                        } else {
                            $bills = Bill::where('branch_id',$request->cabang)->whereBetween('tanggal_nota',[$dateFrom,$dateTo])->get();
                        }
                    }else{
                        $bills = Bill::whereBetween('tanggal_nota',[$dateFrom,$dateTo])->get();
                    }
                    if ($request->pdf) {
                        $data = [
                            'bills'=>$bills,
                            'branch'=> $branch,
                            'app'=>$app,
                            'dateNow'=>Carbon::now()->format('d F Y')
                        ];
                        $pdf = PDF::loadView('pdf.penjualan_hari', $data);
                        // return $pdf->stream();
                        return $pdf->download('penjualan.pdf');
                    }
                }else if($request->filter === "bulan"){
                    if ($request->filter2 === "cabang") {
                        if ($request->cabang == "0") {
                            $bills = Bill::whereMonth('tanggal_nota',$request->bulan)
                                    ->whereYear('tanggal_nota',$request->bulantahun)
                                    ->get()
                                    ->groupBy(function($val) {
                                        return Carbon::parse($val->tanggal_nota)->format('d');
                                    });
                        } else {
                            $bills = Bill::where('branch_id',$request->cabang)
                                    ->whereMonth('tanggal_nota',$request->bulan)
                                    ->whereYear('tanggal_nota',$request->bulantahun)
                                    ->get()
                                    ->groupBy(function($val) {
                                        return Carbon::parse($val->tanggal_nota)->format('d');
                                    });
                        }
                    }else{
                        $bills = Bill::whereMonth('tanggal_nota',$request->bulan)
                                    ->whereYear('tanggal_nota',$request->bulantahun)
                                    ->get()
                                    ->groupBy(function($val) {
                                        return Carbon::parse($val->tanggal_nota)->format('d');
                                    });
                    }
                    $data = [];
                    foreach ($bills as $key => $bill) {
                        $data[$key]['tanggal'] = $key;
                        $data[$key]['penjualan'] = $bill->where('status','lunas')->count();
                        $data[$key]['nominal_penjualan']=$bill->where('status','lunas')->sum('total_nota');
                        $data[$key]['piutang'] = $bill->where('status','piutang')->count();
                        $data[$key]['nominal_piutang']=$bill->where('status','piutang')->sum('kembalian_nota');
                        $data[$key]['kas']= $data[$key]['nominal_penjualan'] - abs($data[$key]['nominal_piutang']);
                    }
                    $month = Carbon::now()->month($request->bulan);
                    if($request->print){

                        return view('pdf.penjualan_bulan',compact('app','dateNow','branch','data','month'));
                    }
                    if ($request->pdf) {
                        $data = [
                            'bills'=>$bills,
                            'branch'=> $branch,
                            'app'=>$app,
                            'dateNow'=>Carbon::now()->format('d F Y'),
                            'data'=>$data,
                            'month'=>$month
                        ];
                        $pdf = PDF::loadView('pdf.penjualan_bulan', $data);
                        // return $pdf->stream();
                        $namafile = "penjualan_bulan_".$month->monthName;
                        return $pdf->download("$namafile.pdf");
                    }
                    return view('penjualan.index',compact('data','branches','bulan','tahun','filter'));
                }else if($request->filter === "tahun"){
                    if ($request->filter2 === "cabang") {
                        if ($request->cabang == "0") {
                            $bills = Bill::whereYear('tanggal_nota',$request->tahun)
                            ->orderBy('tanggal_nota', 'asc')
                            ->get()
                            ->groupBy(function($val) {
                                return Carbon::parse($val->tanggal_nota)->format('m');
                          });
                        } else {
                            $bills = Bill::where('branch_id',$request->cabang)
                            ->whereYear('tanggal_nota',$request->tahun)
                            ->orderBy('tanggal_nota', 'asc')
                            ->get()
                            ->groupBy(function($val) {
                                return Carbon::parse($val->tanggal_nota)->format('m');
                          });
                        }
                    }else{
                        $bills = Bill::whereYear('tanggal_nota',$request->tahun)
                        ->orderBy('tanggal_nota', 'asc')
                        ->get()
                        ->groupBy(function($val) {
                            return Carbon::parse($val->tanggal_nota)->format('m');
                      });
                    }
                    $data = [];
                    foreach ($bills as $key => $bill) {
                        $data[$key]['tanggal'] = $key;
                        $data[$key]['penjualan'] = $bill->where('status','lunas')->count();
                        $data[$key]['nominal_penjualan']=$bill->where('status','lunas')->sum('total_nota');
                        $data[$key]['piutang'] = $bill->where('status','piutang')->count();
                        $data[$key]['nominal_piutang']=$bill->where('status','piutang')->sum('kembalian_nota');
                        $data[$key]['kas']= $data[$key]['nominal_penjualan'] - abs($data[$key]['nominal_piutang']);
                    }
                    $year = Carbon::now()->year($request->tahun);
                    if($request->print){

                        return view('pdf.penjualan_tahun',compact('app','dateNow','branch','data','year'));
                    }
                    if ($request->pdf) {
                        $data = [
                            'bills'=>$bills,
                            'branch'=> $branch,
                            'app'=>$app,
                            'dateNow'=>Carbon::now()->format('d F Y'),
                            'data'=>$data,
                            'year'=>$year
                        ];
                        $pdf = PDF::loadView('pdf.penjualan_tahun', $data);
                        // return $pdf->stream();
                        $namafile = "penjualan_tahun_".$year->year;
                        return $pdf->download("$namafile.pdf");
                    }
                    return view('penjualan.index',compact('data','branches','bulan','tahun'));

                }else if($request->filter === "status"){
                    if ($request->filter2 === "cabang") {
                        if ($request->cabang == "0") {
                            $bills = Bill::where('status',$request->status)
                            ->get();

                        } else {
                            $bills = Bill::where([
                                ['status',$request->status],
                                ['branch_id',$request->cabang]
                                ])
                            ->get();
                        }
                    }else{
                        $bills = Bill::where('status',$request->status)
                        ->get();
                    }
                }else{
                    $bills = Bill::all();
                }
                $filter = $request->filter;
            }else{
                $bills = Bill::all();
            }

            if ($request->pdf) {
                $data = [
                    'bills'=>$bills,
                    'branch'=> $branch,
                    'app'=>$app,
                    'dateNow'=>Carbon::now()->format('d F Y')
                ];
                $pdf = PDF::loadView('pdf.penjualan_hari', $data);
                // return $pdf->stream();
                return $pdf->download('penjualan.pdf');
            }else if($request->print){
                return view('pdf.penjualan_hari',compact('bills','app','dateNow','branch'));
            }

        }else{
            if ($request) {
                if ($request->filter === "hari") {
                    $explodedatetime = explode(' ',$request->hari);
                    $explodeddateFrom = explode('/',$explodedatetime[0]);
                    $explodeddateTo = explode('/',$explodedatetime[3]);
                    $dateFrom = $explodeddateFrom[2]."-".$explodeddateFrom[0]."-".$explodeddateFrom[1]." ".$explodedatetime[1];
                    $dateTo =  $explodeddateTo[2]."-".$explodeddateTo[0]."-".$explodeddateTo[1]." ".$explodedatetime[4];
                    if ($request->filter2 === "status") {
                        if ($request->status == "0") {
                            $bills = Bill::where('branch_id',$user->employee->branch_id)
                            ->whereBetween('tanggal_nota',[$dateFrom,$dateTo])
                            ->get();
                        } else {
                            $bills = Bill::where([
                                ['status','=',$request->status],
                                ['branch_id','=',$user->employee->branch_id]
                            ])
                            ->whereBetween('tanggal_nota',[$dateFrom,$dateTo])
                            ->get();
                        }
                    }else{
                        $bills = Bill::where('branch_id',$user->employee->branch_id)
                        ->whereBetween('tanggal_nota',[$dateFrom,$dateTo])
                        ->get();
                    }
                    if ($request->pdf) {
                        $data = [
                            'bills'=>$bills,
                            'branch'=> $branch,
                            'app'=>$app,
                            'date'=>Carbon::now()->format('d F Y')
                        ];
                        $pdf = PDF::loadView('pdf.penjualan_hari', $data);
                        // return $pdf->stream();
                        return $pdf->download('penjualan.pdf');
                    }
                }else if($request->filter === "bulan"){
                    if ($request->filter2 === "status") {
                        if ($request->status == "0") {
                            $bills = Bill::where('branch_id',$user->employee->branch_id)
                                        ->whereMonth('tanggal_nota',$request->bulan)
                                        ->whereYear('tanggal_nota',$request->bulantahun)
                                        ->orderBy('tanggal_nota', 'asc')
                                        ->get()
                                        ->groupBy(function($val) {
                                            return Carbon::parse($val->tanggal_nota)->format('d');
                                        });
                        } else {
                            $bills = Bill::where([
                                ['status','=',$request->status],
                                ['branch_id','=',$user->employee->branch_id]
                            ])
                            ->whereMonth('tanggal_nota',$request->bulan)
                            ->whereYear('tanggal_nota',$request->bulantahun)
                            ->orderBy('tanggal_nota', 'asc')
                            ->get()
                            ->groupBy(function($val) {
                                return Carbon::parse($val->tanggal_nota)->format('d');
                          });
                        }
                    }else{
                        $bills = Bill::where('branch_id',$user->employee->branch_id)
                                    ->whereMonth('tanggal_nota',$request->bulan)
                                    ->whereYear('tanggal_nota',$request->bulantahun)
                                    ->orderBy('tanggal_nota', 'asc')
                                    ->get()
                                    ->groupBy(function($val) {
                                        return Carbon::parse($val->tanggal_nota)->format('d');
                                });
                    }
                    $data = [];
                    foreach ($bills as $key => $bill) {
                        $data[$key]['tanggal'] = $key;
                        $data[$key]['penjualan'] = $bill->where('status','lunas')->count();
                        $data[$key]['nominal_penjualan']=$bill->where('status','lunas')->sum('total_nota');
                        $data[$key]['piutang'] = $bill->where('status','piutang')->count();
                        $data[$key]['nominal_piutang']=$bill->where('status','piutang')->sum('kembalian_nota');
                        $data[$key]['kas']= $data[$key]['nominal_penjualan'] - abs($data[$key]['nominal_piutang']);
                    }
                    if ($request->pdf) {
                        $data = [
                            'bills'=>$bills,
                            'branch'=> $branch,
                            'app'=>$app,
                            'dateNow'=>Carbon::now()->format('d F Y'),
                            'data'=>$data,
                            'month'=>$month
                        ];
                        $pdf = PDF::loadView('pdf.penjualan_bulan', $data);
                        // return $pdf->stream();
                        return $pdf->download('penjualan_bulan.pdf');
                    }
                    return view('penjualan.index',compact('data','branches','bulan','tahun','filter'));
                }else if($request->filter === "tahun"){
                    if ($request->filter2 === "status") {
                        if ($request->status == "0") {
                            $bills = Bill::where('branch_id',$user->employee->branch_id)
                                    ->whereYear('tanggal_nota',$request->tahun)
                                    ->orderBy('tanggal_nota', 'asc')
                                    ->get()
                                    ->groupBy(function($val) {
                                        return Carbon::parse($val->tanggal_nota)->format('m');
                                });
                        } else {
                            $bills = Bill::where([
                                        ['status','=',$request->status],
                                        ['branch_id','=',$user->employee->branch_id]
                                    ])
                                    ->whereYear('tanggal_nota',$request->tahun)
                                    ->orderBy('tanggal_nota', 'asc')
                                    ->get()
                                    ->groupBy(function($val) {
                                        return Carbon::parse($val->tanggal_nota)->format('m');
                                });
                        }
                    }else{
                        $bills = Bill::where('branch_id',$user->employee->branch_id)
                                ->whereYear('tanggal_nota',$request->tahun)
                                ->orderBy('tanggal_nota', 'asc')
                                ->get()
                                ->groupBy(function($val) {
                                    return Carbon::parse($val->tanggal_nota)->format('m');
                            });
                    }
                    $data = [];
                    foreach ($bills as $key => $bill) {
                        $data[$key]['tanggal'] = $key;
                        $data[$key]['penjualan'] = $bill->where('status','lunas')->count();
                        $data[$key]['nominal_penjualan']=$bill->where('status','lunas')->sum('total_nota');
                        $data[$key]['piutang'] = $bill->where('status','piutang')->count();
                        $data[$key]['nominal_piutang']=$bill->where('status','piutang')->sum('kembalian_nota');
                        $data[$key]['kas']= $data[$key]['nominal_penjualan'] - abs($data[$key]['nominal_piutang']);
                    }
                    if ($request->pdf) {
                        $data = [
                            'bills'=>$bills,
                            'branch'=> $branch,
                            'app'=>$app,
                            'dateNow'=>Carbon::now()->format('d F Y'),
                            'data'=>$data,
                            'year'=>$month
                        ];
                        $pdf = PDF::loadView('pdf.penjualan_tahun', $data);
                        // return $pdf->stream();
                        return $pdf->download('penjualan_tahun.pdf');
                    }
                    return view('penjualan.index',compact('data','branches','bulan','tahun','filter'));

                }else{
                    $bills = Bill::where('branch_id',$user->employee->branch_id)->get();
                }
            }else{
                $bills = Bill::where('branch_id',$user->employee->branch_id)->get();
            }
            if ($request->pdf) {
                $data = [
                    'bills'=>$bills,
                    'branch'=> $branch,
                    'app'=>$app,
                    'date'=>Carbon::now()->format('d F Y')
                ];
                $pdf = PDF::loadView('pdf.penjualan_hari', $data);
                // return $pdf->stream();
                return $pdf->download('penjualan.pdf');
            }
        }



        return view('penjualan.index',compact('bills','branches','bulan','tahun','filter'));
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
        return redirect()->route('penjualan.index');
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
        $app = Application::first();
        $branch = $user->employee->branch;
        $dateNow = Carbon::now()->format('d F Y');
        if ($user->level_id == 1) {
            if ($request->filter === "hari") {

                $explodedatetime = explode(' ',$request->hari);
                $explodeddateFrom = explode('/',$explodedatetime[0]);
                $explodeddateTo = explode('/',$explodedatetime[3]);
                $dateFrom = $explodeddateFrom[2]."-".$explodeddateFrom[0]."-".$explodeddateFrom[1]." ".$explodedatetime[1];
                $dateTo =  $explodeddateTo[2]."-".$explodeddateTo[0]."-".$explodeddateTo[1]." ".$explodedatetime[4];

                if ($request->filter2 === "cabang") {
                    if ($request->cabang == "0") {
                        $bills = Bill::where('status','piutang')->whereBetween('tanggal_nota',[$dateFrom,$dateTo])->get();
                    } else {
                        $bills = Bill::where([
                            ['branch_id','=',$request->cabang],
                            ['status','=','piutang']
                            ])->whereBetween('tanggal_nota',[$dateFrom,$dateTo])->get();
                    }
                }else{
                    $bills = Bill::where('status','piutang')->whereBetween('tanggal_nota',[$dateFrom,$dateTo])->get();
                }

            }if ($request->filter2 === "cabang") {
                if ($request->cabang == "0") {
                    $bills = Bill::where('status','piutang')->whereBetween('tanggal_nota',[$dateFrom,$dateTo])->get();
                } else {
                    $bills = Bill::where([
                        ['branch_id','=',$request->cabang],
                        ['status','=','piutang']
                        ])->get();
                }
            }else{
                $bills = Bill::where('status','piutang')->get();
            }

            if ($request->pdf) {
                $data = [
                    'bills'=>$bills,
                    'branch'=> $branch,
                    'app'=>$app,
                    'date'=>Carbon::now()->format('d F Y')
                ];
                $pdf = PDF::loadView('pdf.piutang', $data);
                // return $pdf->stream();
                return $pdf->download('piutang.pdf');
            }else if($request->print){
                return view('pdf.piutang',compact('bills','app','dateNow','branch'));
            }
        }else{
            if ($request->filter === "hari") {
                $explodedatetime = explode(' ',$request->hari);
                $explodeddateFrom = explode('/',$explodedatetime[0]);
                $explodeddateTo = explode('/',$explodedatetime[3]);
                $dateFrom = $explodeddateFrom[2]."-".$explodeddateFrom[0]."-".$explodeddateFrom[1]." ".$explodedatetime[1];
                $dateTo =  $explodeddateTo[2]."-".$explodeddateTo[0]."-".$explodeddateTo[1]." ".$explodedatetime[4];
                $bills = Bill::where([
                    ['branch_id','=',$user->employee->branch_id],
                    ['status','=','piutang']
                    ])
                    ->whereBetween('tanggal_nota',[$dateFrom,$dateTo])
                            ->get();
            }else{
                $bills = Bill::where([
                    ['branch_id','=',$user->employee->branch_id],
                    ['status','=','piutang']
                    ])->get();
            }
            if ($request->pdf) {
                $data = [
                    'bills'=>$bills,
                    'branch'=> $branch,
                    'app'=>$app,
                    'date'=>Carbon::now()->format('d F Y')
                ];
                $pdf = PDF::loadView('pdf.piutang', $data);
                // return $pdf->stream();
                return $pdf->download('piutang.pdf');
            }
        }

        return view('piutang.index',compact('bills','branches'));
    }

    public function piutanglunas($id)
    {
        $bill =Bill::findOrFail($id);

        $bill->update([
            'status'=>'lunas',
            'jumlah_uang_nota'=>$bill->total_nota,
            'kembalian_nota'=>0,
            'updated_by'=>Auth::user()->id
        ]);

        return redirect()->route('penjualan.detail',$bill->id);
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

    public function cetaknotapiutang($id)
    {
        $bill = Bill::findOrFail($id);
        $app = Application::first();

        $data = [
            'bill'=>$bill,
            'app'=>$app,
        ];
        $pdf = PDF::loadView('pdf.penjualannota', $data);
        // return $pdf->stream();
        $pdfname = "nota piutang".$bill->no_nota_kas;
        return $pdf->download("$pdfname.pdf");
        // return view('pdf.piutang_nota',compact('bill','app'));
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
            'no_nota_kas'=>$request->data['no_nota_kas'],
            'created_by'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id
        ]);

        foreach ($request->data['items'] as $key => $item) {
            $newBill->transaction()->create([
                'no_urut'=>$item['no_urut'],
                'total_harga'=>$item['total_harga'],
                'kuantitas'=>$item['kuantitas'],
                'supply_id'=>$item['supply_id'],
                'created_by'=>Auth::user()->id,
                'updated_by'=>Auth::user()->id
            ]);
            $supply = Supply::findOrFail($item['supply_id']);
            $stokbaru = $supply->stok - $item['kuantitas'];
            $supply->update([
                'stok'=> $stokbaru
            ]);
        }

        return response()->json([
            'data'=>$newBill,
            'status'=>true
        ]);
    }

    public function cetaknota($id)
    {
        $bill = Bill::findOrFail($id);
        $app = Application::first();

        $data = [
            'bill'=>$bill,
            'app'=>$app,
        ];
        // $pdf = PDF::loadView('pdf.penjualannota', $data);
        // // return $pdf->stream();
        // $pdfname = "penjualan_".$bill->no_nota_kas;
        // return $pdf->download("$pdfname.pdf");
        // return view('pdf.penjualannota',compact('bill','app'));
        // return view('pdf.invoice');
        $pdf = PDF::loadView('pdf.invoice');
        // return $pdf->stream();
        // $pdfname = "penjualan_".$bill->no_nota_kas;
        return $pdf->download("test.pdf");
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
