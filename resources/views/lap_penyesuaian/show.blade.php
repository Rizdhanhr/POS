@extends('layouts.app1')
@section('title','Detail Penyesuaian')
@push('css')
    @once


    @endonce
@endpush
@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Detail Penyesuaian {{ $no_penyesuaian }}</h6>
            {{-- <a href="" class="btn btn-primary">Transaksi Pembelian</a> --}}

        </div>
        <div class="table table-responsive table-striped">
            <table id="table_mahasiswa" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" width="10%">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col" width="15%">Stok Tercatat</th>
                        <th scope="col" width="15%">Stok Aktual</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penyesuaian as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama_barang }}</td>
                        <td>{{ $p->stok_tercatat }}</td>
                        <td>{{ $p->stok_aktual }}</td>
                        <td>{{ $p->keterangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->



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


    @endonce
@endpush
