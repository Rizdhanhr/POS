@extends('layouts.app1')
@push('css')
@once

@endonce
@endpush
@section('title','Penyesuaian')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data Penyesuaian</h6>
                <form class="row g-3">
                    <div class="col-md-6">
                      <label for="validationCustom01" class="form-label">Pilih Barang</label>
                      <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                    </div>
                    <div class="col-md-6">
                      <label for="validationCustom02" class="form-label">No Transaksi</label>
                      <input type="text" class="form-control" id="validationCustom02" value="Otto" readonly>
                    </div>
                    <hr  style="color:red; height:3px;">
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="validationCustom03" required>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom03" class="form-label">Stok Tercatat</label>
                        <input type="text" class="form-control" id="validationCustom03" required>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom03" class="form-label">Stok Aktual</label>
                        <input type="text" class="form-control" id="validationCustom03" required>
                      </div>
                      <div class="col-md-2">
                        <label for="validationCustom03" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="validationCustom03" required>
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
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
<!-- Recent Sales End -->
@endsection
@push('script')
    @once

    @endonce
@endpush
