@extends('layouts.app1')
@section('title','Laporan Penjualan')
@push('css')
    @once
        
      
    @endonce
@endpush
@section('content')

<div class="container-fluid pt-4 px-4">
  
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Laporan Penjualan</h6>
            {{-- <a href="" class="btn btn-primary">Transaksi Pembelian</a> --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fa fa-filter" aria-hidden="true"></i> &nbsp;Filter Tanggal
            </button>
        </div>
        <div class="table table-responsive table-striped">
            <table id="table_mahasiswa" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" width="10%">No</th>
                        <th scope="col">No Transaksi</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
          
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Filter Laporan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('cari-penjualan') }}" method="GET">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Dari</label>
                <input type="date" class="form-control @error('dari') is-invalid @enderror" name="dari" id="exampleFormControlInput1">
                <span style="color: red">@error('dari') {{ $message }} @enderror</span>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Sampai</label>
                <input type="date" class="form-control" name="sampai" id="sampai" >
                <span style="color: red">@error('sampai') {{ $message }} @enderror</span>
            </div>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Proses</button>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection
@push('script')
    @once
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    {{-- <script>
        $(document).ready( function () {
            $('#table_mahasiswa').DataTable();
        });

        // $(document).ready(function() {
        //     toastr.options.timeOut = 10000;
        //     @if (Session::has('error'))
        //         toastr.error('{{ Session::get('error') }}');
        //     @elseif(Session::has('success'))
        //         toastr.success('{{ Session::get('success') }}');
        //     @endif
        // });
    </script> --}}

    <script>
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;

        var today = year + "-" + month + "-" + day;       
        document.getElementById("sampai").value = today;
    </script>
    @endonce
@endpush