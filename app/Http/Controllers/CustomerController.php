<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Branch;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return $customer;
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return $customer;
    }

    public function create()
    {
        $branches = Branch::all();
        // TODO return view()
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'telepon'=>'required'
        ]);

        $newCustomer = Customer::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'branch_id'=>$user->employee->branch_id
        ]);

        return $newCustomer;
    }

    public function edit($id)
    {
        $branches = Branch::all();
        $customer = Customer::findOrFail($id);

        return $customer;
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
            'branch_id'=>$request->branch_id
        ]);

        return $updatedCustomer;
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
        return true;
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
