<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Branch;
use App\Application;
use Carbon\Carbon;
class PrintController extends Controller
{
    public function preview()
    {
        $employees = Employee::all();
        $branch = Branch::findOrFail(1);
        $app = Application::first();
        $date=Carbon::now()->format('d F Y');
        return view('print.karyawan',compact('employees','branch','app','date'));
    }
}
