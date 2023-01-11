@extends('layouts.app1')
@push('css')
@once

@endonce
@endpush
@section('title','Penjualan')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Penjualan</h6>
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Transaksi Penjualan</a>
        </div>
        <div class="table-responsive">
            <table id="table_mahasiswa" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" width="10%">No</th>
                        <th scope="col" width="20%">No Transaksi</th>
                        <th scope="col" width="10%">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                   @foreach ($penjualan as $p)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p->no_trx }}</td>
                        <td>{{ $p->jumlah }}</td>
                        <td>@currency($p->harga)</td>
                        <td>
                            <a class="btn btn-sm btn-success" target="_blank" href="{{ route('cetak-penjualan',$p->no_trx) }}">Cetak</a>
                            <a class="btn btn-sm btn-primary" href="{{ route('penjualan.show',$p->no_trx) }}">Detail</a>
                            <button  type="button" data-bs-toggle="modal" data-bs-target="#hapus-{{ $p->id }}" class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

{{-- Modal Hapus --}}
@foreach($penjualan as $p)
<div class="modal fade" id="hapus-{{ $p->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('penjualan.destroy',$p->id) }}" method="POST">
            @csrf
            @method('DELETE')
        Apakah anda ingin menghapus data?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Hapus</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
{{-- Modal Hapus End --}}

@endsection
@push('script')
@once
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
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
    </script>
@endonce
@endpush