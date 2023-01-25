@extends('layouts.app1')
@push('css')
@once

@endonce
@endpush
@section('title','Stok Menipis')
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Stok Menipis</h6>

        </div>
        <div class="table-responsive">
            <table id="table_mahasiswa" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" width="10%">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama</th>
                        <th scope="col" width="10%">Stok</th>
                        <th scope="col" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($stok as $k)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $k->kode }}</td>
                        <td>{{ $k->nama }}</td>
                        <td><span class="badge text-bg-danger">{{ $k->stok }}</span></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('barang.show',$k->id) }}">Detail</a>
                        </td>
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
