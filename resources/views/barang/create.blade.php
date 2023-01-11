@extends('layouts.app1')
@section('title','Tambah Barang')
@push('script')
    @once
 
    @endonce
@endpush
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tambah Barang</h6>
                {{-- <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Supplier" value="{{ old('nama') }}" id="exampleInputEmail1">
                        <span style="color :red">@error('nama')
                            {{ $message }}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No Hp</label>
                        <input type="number" name="no" class="form-control @error('no') is-invalid @enderror" placeholder="Masukkan No Hp Supplier" value="{{ old('no') }}" id="exampleInputEmail1">
                        <span style="color :red">@error('no')
                            {{ $message }}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                        <textarea name="alamat" placeholder="Masukkan Alamat" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                        <span style="color :red">@error('alamat')
                            {{ $message }}
                        @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form> --}}
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Standard</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Advance</button>
                    </li>
                </ul>
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    </br>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Kode Barang</label>
                            <input type="text" name="kode" class="form-control" value="{{ 'BRG-'.$kd}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Nama Barang</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama Barang">
                            <span style="color : red"> @error('nama') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Kategori</label>
                            <select class="form-select @error('kategori') is-invalid @enderror" aria-label="Default select example" name="kategori"> 
                                <option selected>Pilih Kategori</option>
                                @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                             
                              </select>     
                              <span style="color : red">@error('kategori') {{ $message }} @enderror</span>                     
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Satuan</label>
                            <select class="form-select @error('satuan') is-invalid @enderror" aria-label="Default select example" name="satuan"> 
                                <option selected>Pilih Satuan</option>
                                @foreach ($satuan as $sat)
                                <option value="{{ $sat->id }}">{{ $sat->nama }}</option>
                                @endforeach
                              </select>              
                              <span style="color : red">@error('satuan') {{ $message }} @enderror</span>                
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label ">Brand</label>
                            <select class="form-select @error('brand') is-invalid @enderror" aria-label="Default select example" name="brand"> 
                                <option selected>Pilih Brand</option>
                                @foreach ($brand as $br)
                                <option value="{{ $br->id }}">{{ $br->nama }}</option>
                                @endforeach
                              </select>         
                              <span style="color : red">@error('brand') {{ $message }} @enderror</span>                     
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" placeholder="Masukkan Stok">
                            <span style="color : red">@error('stok') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Stok Minimal</label>
                            <input type="number" name="stok_minim" class="form-control @error('stok_minim') is-invalid @enderror" placeholder="Masukkan Stok Minimal">
                            <span style="color : red">@error('stok_minim') {{ $message }} @enderror </span>
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" placeholder="Masukkan Harga Beli">
                            <span style="color : red"> @error('harga_beli') {{ $message }} @enderror </span>
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" placeholder="Masukkan Harga Jual">
                            <span style="color : red">@error('harga_jual') {{ $message }} @enderror</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href='{{ url('barang') }}'" class="btn btn-danger">Batal</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                </br>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Keterangan</label>
                    <input type="text" name="ket" class="form-control" placeholder="Masukkan Keterangan">
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Masukkan Lokasi">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Masukkan Gambar</label>
                    <input class="form-control @error('gambar') is-invalid @enderror" type="file" name="gambar" id="formFile">
                    <span style="color : red"> @error('gambar') {{ $message }} @enderror</span>
                  </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" onclick="window.location.href='{{ url('barang') }}'" class="btn btn-danger">Batal</button>
                <button class="btn btn-warning" type="reset">Reset</button>
                </div>
            </form>
        </div>       
    </div>
 
</div>


<!-- Recent Sales End -->


        
<!-- Recent Sales End -->
@endsection
@push('script')
    @once
   
    @endonce
@endpush