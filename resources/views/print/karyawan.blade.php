@extends('layouts.print')
@push('css')
    <style>
        .border-atas{
                border-top: 2px solid black !important;
        }
        .border-bawah{
            border-bottom: 2px solid black !important;
        }
    </style>
@endpush
@section('content')
<div class="row pt-5" >
        <div class="col-12">
            <h4 class="text-center text-bold">DAFTAR KARYAWAN</h4>
            <h4 class="text-center text-bold">{{ strtoupper($app->toko) }} {{ strtoupper($branch->nama) }}</h4>
        </div>
    <div class="col-12 mt-4">
        <table class="table table-hover">
                <tr>
                    <th class="border-atas">No.</th>
                    <th class="border-atas">Nama</th>
                    <th class="border-atas">Jabatan</th>
                    <th class="border-atas">Alamat</th>
                    <th class="border-atas">Telepon</th>
                    <th class="border-atas">Cabang</th>
                </tr>
            <tbody>
                @foreach ($employees as $employee)
                    @if ($loop->iteration == 1)
                    <tr>
                        <td class="border-atas">{{$loop->iteration}}</td>
                        <td class="border-atas">{{$employee->nama}}</td>
                        <td class="border-atas">{{$employee->jabatan}}</td>
                        <td class="border-atas">{{$employee->alamat}}</td>
                        <td class="border-atas">{{$employee->telepon}}</td>
                        <td class="border-atas">{{$employee->branch->nama}}</td>
                    </tr>
                    @elseif ($loop->iteration == count($employees))
                        <tr>
                            <td class="border-bawah">{{$loop->iteration}}</td>
                            <td class="border-bawah">{{$employee->nama}}</td>
                            <td class="border-bawah">{{$employee->jabatan}}</td>
                            <td class="border-bawah">{{$employee->alamat}}</td>
                            <td class="border-bawah">{{$employee->telepon}}</td>
                            <td class="border-bawah">{{$employee->branch->nama}}</td>
                        </tr>
                    @else
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$employee->nama}}</td>
                        <td>{{$employee->jabatan}}</td>
                        <td>{{$employee->alamat}}</td>
                        <td>{{$employee->telepon}}</td>
                        <td>{{$employee->branch->nama}}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 text-md-right">
        <p>
            {{$branch->nama}},{{$date}} <br>
            Manager Cabang, <br><br><br><br>
            <strong>{{$branch->pimpinan}}</strong>
        </p>
    </div>
</div>
@endsection

      {{-- <!-- jQuery -->
  <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/adminlte/dist/js/adminlte.min.js"></script>
  <script>
    window.addEventListener("afterprint", function(){
      history.back();
    });
    $("#body_print").ready(function(){
      window.print();
    });
  </script> --}}
