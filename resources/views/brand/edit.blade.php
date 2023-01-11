@extends('layouts.app1')
@section('title','Brand')
@push('script')
    @once
        
    @endonce
@endpush
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Brand</h6>
                @foreach($brand as $k)
                <form action="{{ route('brand.update',$k->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $k->nama }}" id="exampleInputEmail1">
                        <span style="color :red">@error('nama')
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