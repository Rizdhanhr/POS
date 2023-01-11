@extends('layouts.app1')
@section('title','Tambah Pembelian')
@push('script')
    @once
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endonce
@endpush
@section('content')
<div class="container-fluid pt-4 px-4">
    {{-- <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Basic Form</h6>
                <form>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Pilih Barang</label>
                        <input type="email" class="form-control" id="exampleInputEmail1">
                       
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Stok Tersedia</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Jumlah</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Diskon</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Horizontal Form</h6>
                <form>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3">
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios"
                                    id="gridRadios1" value="option1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    First radio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gridRadios"
                                    id="gridRadios2" value="option2">
                                <label class="form-check-label" for="gridRadios2">
                                    Second radio
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Checkbox</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Check me out
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Pembelian</h5>
              <form action="{{ route('pembelian.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Pilih Barang</label>
                    <select onchange="getnama(this.value)" name="barang" class="form-select js-example-basic-single @error('barang') is-invalid @enderror" aria-label="Default select example">
                        <option selected>Pilih Barang</option>
                        @foreach($barang as $b)
                        <option value="{{ $b->id }}">{{ $b->kode }} | {{ $b->nama }}</option>
                        @endforeach
                      </select>
                      <span style="color:red">@error('barang') {{ $message }} @enderror</span>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama" id="nama" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Stok Tersedia</label>
                    <input type="text" class="form-control" name="stok" id="stok" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label ">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" id="exampleInputPassword1">
                    <span style="color :red">@error('jumlah') {{ $message }} @enderror</span>
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan</button>
            </form>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Keranjang</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col" width="10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($pembelian as $p)
                  <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->jumlah }}</td>
                    <td>@currency($p->subtotal)</td>
                    <td>
                        <form action="{{ route('pembelian.destroy',$p->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                      
                        </form>
                    </td>
                  </tr>
                   @endforeach
                </tbody>
              </table>
              <hr>
              <form action="{{URL::to('/')}}/proses-pembelian" method="POST">
              @csrf
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Supplier</label>
                <select class="form-select js-example-basic-single @error('supplier') is-invalid @enderror" name="supplier" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    @foreach($supplier as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                  </select>
                  <span style="color : red">@error('supplier') {{ $message }} @enderror</span>
              </div>
             
             <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Total Harga</label>
                <h1>@currency($total)</h1>
                {{-- <input type="text" class="form-control" id="exampleInputPassword1" readonly> --}}
            </div>
              <button type="submit" class="btn btn-primary">Proses</button>
              <button type="button" onclick="window.location.href='{{ url('clear',$user->id) }}'" class="btn btn-danger">Clear Cart</button>
            </form>
              
      
            </div>
          </div>
        </div>
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
                $("#harga").val(data['harga_beli']);
                $("#stok").val(data['stok']);
            },
        });
       }
    </script>
    @endonce
@endpush