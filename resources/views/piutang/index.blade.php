@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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
                  <th>No. Nota Kas</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Piutang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>K18022018
                  </td>
                  <td>Karisman</td>
                  <td>Jl. Jalan</td>
                  <td>081234567890</td>
                  <td>Rp. 2.000.000,-</td>
                  <td>Aksi</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>K18022018
                  </td>
                  <td>Karisman</td>
                  <td>Jl. Jalan</td>
                  <td>081234567890</td>
                  <td>Rp. 2.000.000,-</td>
                  <td>Aksi</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>K18022018
                  </td>
                  <td>Karisman</td>
                  <td>Jl. Jalan</td>
                  <td>081234567890</td>
                  <td>Rp. 2.000.000,-</td>
                  <td>Aksi</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>K18022018
                  </td>
                  <td>Karisman</td>
                  <td>Jl. Jalan</td>
                  <td>081234567890</td>
                  <td>Rp. 2.000.000,-</td>
                  <td>Aksi</td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>K18022018
                  </td>
                  <td>Karisman</td>
                  <td>Jl. Jalan</td>
                  <td>081234567890</td>
                  <td>Rp. 2.000.000,-</td>
                  <td>Aksi</td>
                </tr>                             
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>No. Nota Kas</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Piutang</th>
                  <th>Aksi</th>
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
@endsection

@push('script')
<!-- DataTables -->
<script src="/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endpush