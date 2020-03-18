<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Hash;
class CashierController extends Controller
{

    public function userlogin()
    {
        $user = Auth::user();

        return view('kasir.detail',compact('user'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('kasir.ubah',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updatedUser = Auth::user();
        $updateEmployee = Auth::user()->employee;
        $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:users,email,'.$updatedUser->id,
            'foto'=>'mimes:jpeg,bmp,png,jpg,ico |max:2000'
        ]);


        if ($request->password) {
            $updatedUser->update([
                'password'=>Hash::make($request->password),
            ]);
        }

        $updatedUser->update([
            'username' => $request->username,
            'email'=>$request->email,
            'updated_by'=>Auth::user()->id,
        ]);

        if ($request->file('foto')) {
                if (!($updateEmployee->foto == "fotos/default.jpg") && file_exists('uploads/'.$updateEmployee->foto)) {
                    File::delete('uploads/'.$updateEmployee->foto);
                }
                $foto = 'fotos/'.time().Str::slug($updateEmployee->nama).'.'.$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('uploads/fotos', $foto);
            $updateEmployee->update([
                'foto'=> $foto
            ]);
        }

        return redirect()->route('kasir.pengguna');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
