@extends('layouts.app1')
@section('title','Tambah Barang')
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
                @foreach($barang as $b)
               
            
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    </br>
                    @method('PUT')
                        <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $b->nama }}">
                            </div>
                         </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $b->nama_kategori }}">
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Satuan</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $b->nama_satuan }}">
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Brand</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $b->nama_brand }}">
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Stok</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $b->stok }}">
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Stok Minimal</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $b->stok_minimal }}">
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Harga Beli</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": @currency($b->harga_beli)">
                                </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Harga Jual</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": @currency($b->harga_jual)">
                                    
                                </div>
                        </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                </br>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            @if($b->spesifikasi)
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $b->spesifikasi }}">
                            @else
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": Belum Diisi">
                            @endif
                        </div>
                </div>
               
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            @if($b->lokasi)
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $b->lokasi }}">
                            @else
                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": Belum Diisi">
                            @endif
                    </div>
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
               
                </div>
            
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