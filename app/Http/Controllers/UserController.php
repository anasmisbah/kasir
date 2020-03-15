<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use App\Employee;
use App\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\APPlication;
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $user = Auth::user();
        $branches = Branch::all();
        $app = Application::first();
        $branch = $user->employee->branch;
        if ($request->all()) {
            if ($request->cabang == "0") {
                $users = User::all();
            }else{
                $users = User::join('employees', 'users.employee_id', '=', 'employees.id')
                            ->join('branches', 'employees.branch_id', '=', 'branches.id')->where('branch_id',$request->cabang)->get();
                $branch = Branch::findOrFail($request->cabang);
            }
            if ($request->print) {
                    $dateNow=Carbon::now();
                return view('print.pengguna',compact('users','branch','app','dateNow','user'));
            }
        }else{
            $users = User::all();
        }
        return view('pengguna.index',compact('users','branches'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('pengguna.detail',compact('user'));
    }

    public function create()
    {
        $levels = Level::all();
        $employeesAll = Employee::all();
        $employees = [];
        foreach ($employeesAll as $employ) {
            if (!$employ->user) {
                $employees[] = $employ;
            }
        }
        return view('pengguna.tambah',compact('levels','employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'level_id'=>'required',
            'employee_id'=>'required'
        ]);

        $newUser = User::create([
            'username' => $request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'level_id'=>$request->level_id,
            'employee_id'=>$request->employee_id,
            'created_by'=>Auth::user()->id,
            'updated_by'=>Auth::user()->id,
        ]);

        return redirect()->route('pengguna.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $levels = Level::all();
        $employeesAll = Employee::all();
        $employees = [];
        foreach ($employeesAll as $employ) {
            if (!$employ->user) {
                $employees[] = $employ;
            }
        }
        return view('pengguna.ubah',compact('user','levels','employees'));
    }

    public function update(Request $request)
    {
        $updatedUser = User::findOrFail($request->id);
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users,email,'.$updatedUser->id,
            'level_id'=>'required',
            'employee_id'=>'required'
        ]);


        if ($request->password) {
            $updatedUser->update([
                'password'=>Hash::make($request->password),
            ]);
        }

        $updatedUser->update([
            'username' => $request->username,
            'email'=>$request->email,
            'level_id'=>$request->level_id,
            'employee_id'=>$request->employee_id,
            'updated_by'=>Auth::user()->id,
        ]);
        return redirect()->route('pengguna.index');
    }

    public function search(Request $request)
    {
        if ($request->keyword) {
            $users = User::where('nama', 'LIKE', "%{$request->keyword}%")->get();
            return $users;
        }else{
            $users = User::all();
            return $users;
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('pengguna.index');
    }
}
