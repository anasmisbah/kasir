@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-1">
            Ayam
        </div>
        <div class="col-3">
            Ayam
        </div>
        <div class="col-2">
            Ayam
        </div>
        <div class="col-1">
            Ayam
        </div>
        <div class="col-2">
            Ayam
        </div>
        <div class="col-1">
            Ayam
        </div>
        <div class="col-2">
            Ayam
        </div>
    </div>
    <div class="row">
        <div class="col-10">
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">DataTable with default features</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Barang 1
                                            </td>
                                            <td>Rp. 20.000,-</td>
                                            <td>5</td>
                                            <td>Rp. 100.000,-</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Barang 1
                                            </td>
                                            <td>Rp. 20.000,-</td>
                                            <td>5</td>
                                            <td>Rp. 100.000,-</td>
                                        <tr>
                                            <td>1</td>
                                            <td>Barang 1
                                            </td>
                                            <td>Rp. 20.000,-</td>
                                            <td>5</td>
                                            <td>Rp. 100.000,-</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    </div>

</div>

    @endsection
