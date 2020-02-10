@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 ">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item">Beranda</li>
            <li class="breadcrumb-item">Barang</li>
            <li class="breadcrumb-item active"><a href="#">Membuat</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
<div class="col-12 mt-1">
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Barang</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link btn-danger active" href="{{ route('barang.index') }}"><i class=" fas fa-times"></i></a>
                      </li>
                    </ul>
                  </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form" action="{{route('barang.simpan')}}" method="POST">
                @csrf
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3"  class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" value="{{ old('nama')}}" name="nama" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm {{ $errors->first('nama')?'is-invalid':'' }}" id="inputEmail3" placeholder="Nama">
                        <div class="invalid-feedback">
                            {{$errors->first('nama')}}
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputjenis" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-10 " style="width: 100%;">
                        <select name="category_id" id="inputjenis" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm" >
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ old('category_id') == $category->id?'selected':''}}>{{$category->nama}}</option>
                        @endforeach
                        </select>
                    </div>
                        <div class="invalid-feedback">
                            jenis barang wajib dipilih
                        </div>
                  </div>

                <div class="form-group row">
                    <label for="inputharga" class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                    <input type="text" value="{{ old('harga')}}" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm form-control form-control-sm-sm form-control form-control-sm form-control form-control-sm-sm-sm {{ $errors->first('harga')?'is-invalid':'' }} divide" id="inputharga" name="harga" placeholder="Harga">
                        <div class="invalid-feedback">
                            {{$errors->first('harga')}}
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn  btn-primary float-right" style="width: 78px !important;"><i class="fa fa-save"></i></button>
            </div>

            <div class="card-footer">
                <p></p>
            </div>
            </form>
            </div>
</div>
@endsection

@push('script')
<script src="/adminlte/plugins/number-divider.min.js"></script>
<script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    $('.select2').select2()

    // Number Divide
    $("#inputharga").divide({
        delimiter:',',
        divideThousand:true
    });

    // Cegah Paid Amount Diisi dengan Huruf
    $("#inputharga").on('keypress', function(keys){
        if(keys.keyCode > 31 && (keys.keyCode < 48 || keys.keyCode > 57)) {
            keys.preventDefault();
        }
    });
});
</script>

@endpush
