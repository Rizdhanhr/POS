@extends('layouts.app1')
@section('title','Edit Barang')
@push('script')
    @once
 <style>
      /* Style the Image Used to Trigger the Modal */
      #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
          }

          #myImg:hover {opacity: 0.7;}

          /* The Modal (background) */
          .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
          }

          /* Modal Content (Image) */
          .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
          }

          /* Caption of Modal Image (Image Text) - Same Width as the Image */
          #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
          }

          /* Add Animation - Zoom in the Modal */
          .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
          }

          @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
          }

          /* The Close Button */
          .close {
            position: absolute;
            top: 60px;
            right: 35px;
            color: #f1f1f1;
            font-size: 100px;
            font-weight: bold;
            transition: 0.3s;
          }

          .close:hover,
          .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
          }

          /* 100% Image Width on Smaller Screens */
          @media only screen and (max-width: 500px){
            .modal-content {
              width: 100%;
            }
          }
 </style>
    @endonce
@endpush
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Barang</h6>
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
                @foreach($barang as $b)
                <form action="{{ route('barang.update',$b->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    </br>
                    @method('PUT')
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Nama Barang</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $b->nama }}">
                            <span style="color : red"> @error('nama') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Kategori</label>
                            <select class="form-select @error('kategori') is-invalid @enderror" aria-label="Default select example" name="kategori">
                                <option selected>Pilih Kategori</option>
                                @foreach ($kategori as $kater)
                                <option {{ $b->id_kategori==$kater->id ? 'selected' : '' }} value="{{ $kater->id }}">{{ $kater->nama }}</option>
                                @endforeach
                              </select>
                              <span style="color : red">@error('kategori') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Satuan</label>
                            <select class="form-select @error('satuan') is-invalid @enderror" aria-label="Default select example" name="satuan">
                                <option selected>Pilih Satuan</option>
                                @foreach ($satuan as $sater)
                                <option {{ $b->id_satuan==$sater->id ? 'selected' : '' }} value="{{ $sater->id }}">{{ $sater->nama }}</option>
                                @endforeach
                              </select>
                              <span style="color : red">@error('satuan') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label ">Brand</label>
                            <select class="form-select @error('brand') is-invalid @enderror" aria-label="Default select example" name="brand">
                                <option selected>Pilih Brand</option>
                                @foreach ($brand as $bre)
                                <option {{ $b->id_brand==$bre->id ? 'selected' : '' }} value="{{ $bre->id }}">{{ $bre->nama }}</option>
                                @endforeach
                              </select>
                              <span style="color : red">@error('brand') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ $b->stok }}" readonly>
                            <span style="color : red">@error('stok') {{ $message }} @enderror</span>
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Stok Minimal</label>
                            <input type="number" name="stok_minim" class="form-control @error('stok_minim') is-invalid @enderror" value="{{ $b->stok_minimal }}">
                            <span style="color : red">@error('stok_minim') {{ $message }} @enderror </span>
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ $b->harga_beli }}">
                            <span style="color : red"> @error('harga_beli') {{ $message }} @enderror </span>
                        </div>
                        <div class="mb-3">
                            <label for="Nama Barang" class="form-label">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ $b->harga_jual }}">
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
                    <input type="text" name="ket" class="form-control" value="{{ $b->spesifikasi }}">
                </div>
                <div class="mb-3">
                    <label for="Nama Barang" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ $b->lokasi }}">
                </div>
                <div class="mb-3">
                    @if ($b->gambar)
                    <img id="myImg" src="{{ asset($b->gambar) }}" alt="Gambar" style="width:100%;max-width:300px">
                    @else
                    <img id="myImg" src="{{ asset('no_image') }}/noimage.jpg" alt="Gambar" style="width:100%;max-width:300px">
                    @endif
                    <div id="myModal" class="modal">

                        <!-- The Close Button -->
                        <span class="close">&times;</span>

                        <!-- Modal Content (The Image) -->
                        <img class="modal-content" id="img01">

                        <!-- Modal Caption (Image Text) -->
                        <div id="caption"></div>
                      </div>
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
            @endforeach
        </div>
    </div>

</div>


<!-- Recent Sales End -->



<!-- Recent Sales End -->
@endsection
@push('script')
    @once
   <script>
     var modal = document.getElementById("myModal");
        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
        }
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }
   </script>
    @endonce
@endpush
