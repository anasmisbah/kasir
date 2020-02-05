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
        $branches = Branch::all();
        return view('karyawan.index',compact('employees','branches'));
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('karyawan.detail',compact('employee'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('karyawan.tambah',compact('branches'));
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
            'telepon'=>$request->telepon,
            'foto'=>$foto
        ]);

        return redirect()->route('karyawan.index');
    }

    public function edit($id)
    {
        $branches = Branch::all();
        $employee = Employee::findOrFail($id);
        return view('karyawan.ubah',compact('employee','branches'));
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

        $updateEmployee = Employee::findOrFail($request->id);

        $updateEmployee->update([
            'nama'=>$request->nama,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'jabatan'=>$request->jabatan,
            'branch_id'=>$request->branch_id,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon
        ]);

        if ($request->file('foto')) {
            if (!($updateEmployee->foto == "fotos/default.jpg") && file_exists(storage_path('app/public/'.$updateEmployee->foto))) {
                Storage::delete('public/'.$updateEmployee->foto);
            }
            $updateEmployee->update([
                'foto'=> $request->file('foto')->store('fotos','public')
            ]);
        }

        return redirect()->route('karyawan.index');
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
        $employee = Employee::findOrFail($id);
        $user = $employee->user;
        if ($user) {
            $user->delete();
        }
        if (!($employee->foto == "fotos/default.jpg") && file_exists(storage_path('app/public/'.$employee->foto))) {
            Storage::delete('public/'.$employee->foto);
        }
        $employee->delete();

        return redirect()->route('karyawan.index');
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
