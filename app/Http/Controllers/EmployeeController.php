<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\User;
use App\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return $employees;
    }

    public function detail($id)
    {
        $employee = Employee::findOrFail($id);
        return $employee;
    }

    public function create()
    {
        $branches = Branch::all();
        return $branches;
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'jenis_kelamin'=>'required',
            'jabatan'=>'required',
            'branch_id'=>'required',
            'alamat'=>'required',
            'telepon'=>'required'
        ]);

        $foto='';
        if ($request->file('foto')) {
            $foto = $request->file('foto')->store('fotos','public');
        }

        $newEmployee = Employee::create([
            'nama'=>$request->nama,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'jabatan'=>$request->jabatan,
            'branch_id'=>$request->branch_id,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon
        ]);

        return $newEmployee;
    }

    public function edit($id)
    {
        $branches = Branch::all();
        $employee = Employee::findOrFail($id);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'jenis_kelamin'=>'required',
            'jabatan'=>'required',
            'branch_id'=>'required',
            'alamat'=>'required',
            'telepon'=>'required'
        ]);

        $employee = Employee::findOrFail($request->id);

        $updateEmployee->update([
            'nama'=>$request->nama,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'jabatan'=>$request->jabatan,
            'branch_id'=>$request->branch_id,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon
        ]);

        if ($request->file('foto')) {
            if ($updateEmployee->foto && file_exists(storage_path('app/public/'.$updateEmployee->foto))) {
                Storage::delete('public/'.$updateEmployee->foto);
            }
            $updateEmployee->update([
                'foto'=> $request->file('foto')->store('fotos','public')
            ]);
        }

        return $updateEmployee;
    }

    public function search(Request $request)
    {
        if ($request->keyword) {
            $employees = Employee::where('nama', 'LIKE', "%{$request->keyword}%")
                            ->get();
            return $employees;
        }else{
            $employees = Employee::all();
            return $employees;
        }
    }

    public function delete($id)
    {
        $employee = Employee::fingOrFail($id);
        $user = $employee->user;
        if ($user) {
            $user->delete();
        }
        if ($employee->foto && file_exists(storage_path('app/public/'.$employee->foto))) {
            Storage::delete('public/'.$employee->foto);
        }
        $employee->delete();

        return true;
    }

    public function filter(Request $request)
    {
        if ($request->filter === "cabang") {
            if ($request->cabang == 0) {
                $employees = Employee::all();
                return $employees;
            }else{
                $employees = Employee::where('branch_id',$request->cabang)->get();
                return $employees;
            }
        }else{
            $employees = Employee::all();
            return $employees;
        }
    }
}
