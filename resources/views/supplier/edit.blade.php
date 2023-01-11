@extends('layouts.app1')
@section('title','Edit Supplier')
@push('script')
    @once
        
    @endonce
@endpush
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Supplier</h6>
                @foreach ($supplier as $k)
                <form action="{{ route('supplier.update',$k->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Supplier</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $k->nama }}" id="exampleInputEmail1">
                        <span style="color :red">@error('nama')
                            {{ $message }}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No Hp</label>
                        <input type="number" name="no" class="form-control @error('no') is-invalid @enderror"  value="{{ $k->no }}" id="exampleInputEmail1">
                        <span style="color :red">@error('no')
                            {{ $message }}
                        @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                        <textarea name="alamat"  cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror">{{ $k->alamat }}</textarea>
                        <span style="color :red">@error('alamat')
                            {{ $message }}
                        @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @endforeach
            </div>
        </div>
<!-- Recent Sales End -->
@endsection
@push('script')
    @once
        
    @endonce
@endpush