<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\User;
use App\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Application;
use Carbon\Carbon;
use Illuminate\Support\Str;
use File;
class EmployeeController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        $branches = Branch::all();
        $app = Application::first();
        $branch = $user->employee->branch;
        $filter_cabang = $request->cabang;
        if ($user->level_id == 1 ) {
            if ($request->all()) {
                if ($request->cabang == "0") {
                    $employees = Employee::all();
                }else{
                    $employees = Employee::where('branch_id',$request->cabang)->get();
                    $branch = Branch::findOrFail($request->cabang);
                }
                if ($request->print) {
                        $date=Carbon::now();
                    return view('print.karyawan',compact('employees','branch','app','date','user','filter_cabang'));
                }
            }else{
                $employees = Employee::all();
            }

            return view('karyawan.index',compact('employees','branches'));
        }else{
            $employees = Employee::where('branch_id',$user->employee->branch_id)->get();
            return view('karyawan.index',compact('employees','branches'));
        }

    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('karyawan.detail',compact('employee'));
    }

    public function getEmployeeJson(Request $request)
    {
        $employee = Employee::findOrFail($request->id);
        $employee->branch;
        return response()->json($employee);
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

        $foto='fotos/default.jpg';

        if ($request->file('foto')) {
            $request->validate([
                'foto'=>'mimes:jpeg,bmp,png,jpg,ico',
            ]);
            $foto = 'fotos/'.time().Str::slug($request->nama).'.'.$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('uploads/fotos', $foto);
        }

        $newEmployee = Employee::create([
            'nama'=>$request->nama,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'jabatan'=>$request->jabatan,
            'branch_id'=>$request->branch_id,
            'alamat'=>$request->alamat,
            'telepon'=>$request->telepon,
            'foto'=>$foto,
            'created_by'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id
        ]);

        $branch = Branch::findOrFail($request->branch_id);
        $kode = $branch->kode.''.str_pad(($newEmployee->id),2,'0',STR_PAD_LEFT);
        $newEmployee->kode = $kode;
        $newEmployee->save();
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
            'telepon'=>$request->telepon,
            'updated_by'=>Auth::user()->id
        ]);
        if ($request->file('foto')) {
            $request->validate([
                'foto'=>'mimes:jpeg,bmp,png,jpg,ico',
            ]);
            if (!($updateEmployee->foto == "fotos/default.jpg") && file_exists('uploads/'.$updateEmployee->foto)) {
                File::delete('uploads/'.$updateEmployee->foto);
            }
            $foto = 'fotos/'.time().Str::slug($request->nama).'.'.$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('uploads/fotos', $foto);

            $updateEmployee->update([
                'foto'=> $foto
            ]);
        }

        if ($request->branch_id != $updateEmployee->branch_id) {
            $branch = Branch::findOrFail($request->branch_id);
            $kode = $branch->kode.''.str_pad(($updateEmployee->id),2,'0',STR_PAD_LEFT);
            $updateEmployee->update([
                'kode'=>$kode,
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
