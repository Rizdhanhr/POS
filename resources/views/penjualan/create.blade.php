@extends('layouts.app1')
@section('title','Tambah Penjualan')
@push('script')
    @once
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endonce
@endpush
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Transaksi Penjualan</h6>
                <form class="row g-3" action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <div class="col-md-6">
                        <label for="exampleInputPassword1" class="form-label">Pilih Barang</label>
                        <select onchange="getnama(this.value)" name="barang" class="form-select js-example-basic-single form-control @error('barang') is-invalid @enderror" aria-label="Default select example">
                            <option selected>Pilih Barang</option>
                            @foreach($barang as $b)
                            <option value="{{ $b->id }}" {{ old('barang') == $b->id ? "selected" : "" }}>{{ $b->kode }} | {{ $b->nama }}</option>
                            @endforeach
                          </select>
                          <span style="color:red">@error('barang') {{ $message }} @enderror</span>
                      </div>
                    <div class="col-md-6">
                      <label for="validationCustom02" class="form-label">No Transaksi</label>
                      <input type="text" class="form-control" name="no_penyesuaian" value="{{ $sku }} "readonly>
                    </div>
                    <hr  style="color:red; height:3px;">
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" readonly>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" value="{{ old('harga') }}" name="harga" readonly>
                      </div>
                      <div class="col-md-2">
                        <label for="validationCustom03" class="form-label">Stok Tercatat</label>
                        <input type="text" class="form-control" id="stok" value="{{ old('stok') }}" name="stok" readonly>
                      </div>
                      <div class="col-md-2">
                        <label for="validationCustom03" class="form-label">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" name="jumlah">
                        <span style="color :red">@error('jumlah') {{ $message }} @enderror</span>
                      </div>

                      <div class="col-md-3">
                        <button class="btn btn-primary btn-sm" type="submit">Tambah</button>
                      </div>
                  </form>
                  <hr  style="color:red; height:3px;">
                  <h6 class="mb-4">Daftar Penjualan</h6>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col" width="15%">Jumlah</th>
                        <th scope="col" width="35%">Subtotal</th>
                        <th scope="col" width="5%">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan as $p)
                      <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $p->nama_barang }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td> @currency($p->subtotal) </td>
                        <td>
                            <form action="{{ route('penjualan.destroy',$p->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                    <hr style="color : black;">
                    <form class="row g-3" action="{{URL::to('/')}}/proses-penjualan" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <label for="exampleInputPassword1" class="form-label">Total Harga</label>
                            <h1>@currency($total),00</h1>
                            {{-- <input type="text" class="form-control" id="exampleInputPassword1" readonly> --}}
                         </div>
                         <div class="col-md-12">
                            <label for="exampleInputPassword1" class="form-label ">Bayar</label>
                            <input type="number" class="form-control @error('bayar') is-invalid @enderror" value="{{ old('bayar') }}" name="bayar" onkeyup="sum()" id="bayar">
                            <span style="color : red">@error('bayar') {{ $message }} @enderror</span>
                         </div>
                         <div class="col-md-12">
                            <label for="exampleInputPassword1" class="form-label">Kembalian</label>
                            <input type="number" class="form-control" name="kembali" onkeyup="sum()" id="kembali" value="0" readonly>
                         </div>
                          {{-- <button type="button" onclick="window.location.href=''" class="btn btn-danger">Clear Cart</button> --}}
                        </br>
                        <input type="hidden" name="total" id="total" onkeyup="sum()" value="{{ $total }}" id="total" readonly>
                        <div class="col-md-12">
                            <button type="submit" style="width:100%;" class=" btn btn-primary">Proses</button>
                            {{-- <button type="button" onclick="window.location.href='{{ url('clear',$user->id) }}'" class="btn btn-danger">Clear Cart</button> --}}
                        </div>
                    </form>
            </div>
        </div>
<!-- Recent Sales End -->
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
            url : "/getbarangout/" + $id ,
            success: function(data){
                $("#nama").val(data['nama']);
                $("#harga").val(data['harga_jual']);
                $("#stok").val(data['stok']);
            },
        });
       }

       function sum(){
        var bayar = document.getElementById('bayar').value;
        var total = document.getElementById('total').value;
        var result = parseInt(bayar) - parseInt(total);
        if(!isNaN(result)){
            document.getElementById('kembali').value=result;
        }
       }
    </script>
    @endonce
@endpush
