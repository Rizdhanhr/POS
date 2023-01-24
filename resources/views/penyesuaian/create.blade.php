@extends('layouts.app1')
@push('css')
@once
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endonce
@endpush
@section('title','Penyesuaian')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data Penyesuaian</h6>
                <form class="row g-3" action="{{ route('penyesuaian.store') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Pilih Barang</label>
                        <select onchange="getnama(this.value)" name="barang" class="form-select js-example-basic-single @error('barang') is-invalid @enderror form-control" aria-label="Default select example">
                            <option selected></option>
                            @foreach($barang as $b)
                            <option value="{{ $b->id }}" {{ old('barang') == $b->id ? "selected":"" }}>{{ $b->kode }}|{{ $b->nama }}</option>
                            @endforeach
                          </select>
                          <span style="color : red">@error('barang') {{ $message }} @enderror</span>
                      </div>
                    <div class="col-md-6">
                      <label for="validationCustom02" class="form-label">No Transaksi</label>
                      <input type="text" class="form-control" name="no_penyesuaian" value={{ $sku }} readonly>
                    </div>
                    <hr  style="color:red; height:3px;">
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" readonly>
                      </div>

                      <div class="col-md-2">
                        <label for="validationCustom03" class="form-label">Stok Tercatat</label>
                        <input type="text" class="form-control" id="stok" value="{{ old('stok_tercatat') }}" name="stok_tercatat" readonly>
                      </div>
                      <div class="col-md-2">
                        <label for="validationCustom03" class="form-label">Stok Aktual</label>
                        <input type="number" class="form-control @error('stok_aktual') is-invalid @enderror" value="{{ old('stok_aktual') }}" name="stok_aktual">
                        <span style="color :red">@error('stok_aktual') {{ $message }} @enderror</span>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror"  value="{{ old('keterangan') }}" name="keterangan">
                        <span style="color :red">@error('keterangan') {{ $message }} @enderror</span>
                      </div>
                      <div class="col-md-3">
                        <button class="btn btn-primary btn-sm" type="submit">Sesuaikan</button>
                      </div>
                  </form>
                  <hr  style="color:red; height:3px;">
                  <h6 class="mb-4">Daftar Barang</h6>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">No</th>
                        <th scope="col" width="15%">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col" width="15%">Stok Tercatat</th>
                        <th scope="col" width="15%">Stok Aktual</th>
                        <th scope="col" width="10%">Selisih</th>
                        <th scope="col" width="5%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($detail as $dt)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $dt->kode_barang }}</td>
                        <td>{{ $dt->nama_barang }}</td>
                        <td>{{ $dt->stok_tercatat }}</td>
                        <td>{{ $dt->stok_aktual }}</td>
                        <td>{{ $dt->stok_tercatat-$dt->stok_aktual}}</td>
                        <td>
                            <form action="{{ route('penyesuaian.destroy',$dt->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                    <form action="{{ route('proses-penyesuaian') }}" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <label for="validationCustom03" class="form-label">Catatan :</label>
                            <input type="text" class="form-control @error('catatan') is-invalid @enderror"  value="{{ old('catatan') }}" name="catatan">
                            <span style="color :red">@error('catatan') {{ $message }} @enderror</span>
                        </div>
                    </br>
                        <div class="col-md-12">
                            <button type="submit" style="width:100%;" class=" btn btn-primary">Proses</button>
                        </div>
                    </form>
            </div>
        </div>
<!-- Recent Sales End -->
@endsection
@push('script')
    @once
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
         $(document).ready(function() {
           $('.js-example-basic-single').select2();
           $(window).resize(function() {
           $('.select2').css('width', "100%");
          });
      });

      function getnama($id){
        $.ajax({
            type : "GET",
            url : "/getbarang/" + $id ,
            success: function(data){
                $("#nama").val(data['nama']);
                $("#stok").val(data['stok']);
            },
        });
       }
    </script>
    @endonce
@endpush
