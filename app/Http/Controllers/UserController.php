<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use App\Employee;

use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pengguna.index',compact('users'));
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
            'email'=>'required',
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
        $request->validate([
            'username'=>'required',
            'email'=>'required',
            'level_id'=>'required',
            'employee_id'=>'required'
        ]);
        $updatedUser = User::findOrFail($request->id);

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
