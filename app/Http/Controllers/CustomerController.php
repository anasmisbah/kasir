<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Branch;
use PDF;
use App\Application;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        $branches = Branch::all();
        $app = Application::first();
        $branch = $user->employee->branch;
        if ($user->level_id == 1) {
            if($request->all()){
                if($request->cabang === "0"){
                    $customers = Customer::all();
                }else{
                    $customers = Customer::where('branch_id',$request->cabang)->get();
                    $branch = Branch::findOrFail($request->cabang);
                }
                if ($request->pdf) {

                    $data = [
                        'customers'=>$customers,
                        'branch'=> $branch,
                        'app'=>$app,
                        'date'=>Carbon::now()->format('d F Y')
                    ];
                    $pdf = PDF::loadView('pdf.pelanggan', $data);
                    // return $pdf->stream();
                    return $pdf->download('pelanggan.pdf');
                }elseif ($request->print) {
                    $date=Carbon::now()->format('d F Y');
                    return view('pdf.pelanggan',compact('customers','branch','app','date'));
                }
            }else{
                $customers = Customer::all();
            }
            return view('pelanggan.index',compact('customers','branches'));
        } else {
            $customers = Customer::where('branch_id',$user->employee->branch_id)->get();
            return view('pelanggan.index',compact('customers','branches'));
        }

    }

    public function getdatajson(Request $request)
    {
        $customers = Customer::where([
            ['branch_id','=',Auth::user()->employee->branch_id],
            ['nama','LIKE',"%{$request->keyword}%"]
            ])->get();

        return response()->json($customers);
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('pelanggan.detail',compact('customer'));
    }

    public function getJsonCustomer(Request $request)
    {
        $customer = Customer::findOrFail($request->id);

        return response()->json([
            'customer'=>$customer
        ]);
    }

    public function storeAjax(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required',
            'branch_id'=>'required'
        ]);

        $newCustomer = Customer::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'branch_id'=>$request->branch_id,
            'created_by'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id
        ]);

        return response()->json([
            'customer'=>$newCustomer
        ]);
    }

    public function create()
    {
        $branches = Branch::all();
        return view('pelanggan.tambah',compact('branches'));
        // TODO return view()
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required',
            'branch_id'=>'required'
        ]);

        $newCustomer = Customer::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'branch_id'=>$request->branch_id,
            'created_by'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id
        ]);

        return redirect()->route('pelanggan.index');
    }

    public function edit($id)
    {
        $branches = Branch::all();
        $customer = Customer::findOrFail($id);

        return view('pelanggan.edit',compact('customer','branches'));;
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required'
        ]);

        $updatedCustomer = Customer::findOrFail($request->id);

        $updatedCustomer->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'branch_id'=>$request->branch_id,
            'updated_by'=>Auth::user()->id
        ]);

        return  redirect()->route('pelanggan.index');;
    }

    public function search(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::where('nama', 'LIKE', "%{$request->keyword}%")
                            ->get();
            return $customers;
        }else{
            $customers = Employee::all();
            return $customers;
        }
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('pelanggan.index');
    }

    public function filter(Request $request)
    {
        if ($request->filter === "cabang") {
            if($request->cabang === 0){
                $customers = Customer::all();
                return $customers;
            }else{
                $customers = Customer::where('branch_id',$request->cabang)->get();
                return $customers;
            }
        }else{
            $customers = Customer::all();
            return $customers;
        }
    }

    public function pdf(Request $request)
    {
        if ($request->filter === "cabang") {
            if($request->cabang === 0){
                $customers = Customer::all();

                return $customers;
            }else{
                $customers = Customer::where('branch_id',$request->cabang)->get();
                return $customers;
            }
        }else{
            $customers = Customer::all();
            return $customers;
        }
    }


}
