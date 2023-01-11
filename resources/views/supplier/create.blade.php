@extends('layouts.app1')
@section('title','Tambah Supplier')
@push('script')
    @once
        
    @endonce
@endpush
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tambah Supplier</h6>
                <form action="{{ route('supplier.store') }}" method="POST">
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
                </form>
            </div>
        </div>
<!-- Recent Sales End -->
@endsection
@push('script')
    @once
        
    @endonce
@endpush