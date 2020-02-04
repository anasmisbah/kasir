<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Level;
use App\Employee;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return $users;
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public function create()
    {
        $levels = Level::all();
        $employees = Employee::all();
        // TODO return view()
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
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

        return $newUser;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $levels = Level::all();
        $employees = Employee::all();
        return $user;
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'email'=>'required',
            'password'=>'required',
            'level_id'=>'required',
            'employee_id'=>'required'
        ]);
        $updatedUser = User::findOrFail($request->id);
        $updatedUser->update([
            'username' => $request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'level_id'=>$request->level_id,
            'employee_id'=>$request->employee_id,
        ]);
        return $updatedUser;
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
        return true;
    }
}
