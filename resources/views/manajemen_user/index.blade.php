@extends('layouts.app1')

@push('css')
    @once
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>

.login_oueter {
    width: 360px;
    max-width: 100%;
}
.logo_outer{
    text-align: center;
}
.logo_outer img{
    width:120px;
    margin-bottom: 40px;
}
    </style>
    @endonce
@endpush
@section('title','Manajemen User')
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Manajemen User</h6>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah User
            </button>
        </div>
        <div class="table-responsive">
            <table id="table_mahasiswa" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col" width="10%">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col" width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $u)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            @if($u->level == '1')
                            <span class="badge text-bg-success">Super Admin</span>
                            @else
                            <span class="badge text-bg-warning">Admin</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success" href="">Edit</a>
                            <button  type="button" data-bs-toggle="modal" data-bs-target="#hapus-" class="btn btn-sm btn-danger">Hapus</button>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<!-- ModalTambah -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('manajemen-user.store') }}">
            @csrf
            <div class="form-row">
                <div class="col-12">
                    <label for="" class="form-label">Nama</label>
                    <div class="input-group mb-3">
                      <input name="name" type="text" value="{{ old('name') }}" class="input form-control @error('name') is-invalid @enderror" id="username" placeholder="Masukkan Nama" aria-label="Username" aria-describedby="basic-addon1" />
                      <span style="color : red">@error('name') {{ $message }} @enderror</span>
                    </div>
                  </div>
                <div class="col-12">
                  <label for="" class="form-label">Email</label>
                  <div class="input-group mb-3">
                    <input name="email" type="email" value="{{ old('email') }}" class="input form-control @error('email') is-invalid @enderror" id="username" placeholder="Masukkan Email" aria-label="Username" aria-describedby="basic-addon1" />
                    <span style="color : red">@error('email') {{ $message }} @enderror</span>
                  </div>
                </div>
                <div class="col-12">
                  <label for="" class="form-label">Password</label>
                  <div class="input-group mb-3">
                    <input name="password" type="password" value="{{ old('password') }}" class="input form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Password" required="true" aria-label="password" aria-describedby="basic-addon1" />
                    <span style="color : red">@error('password') {{ $message }} @enderror</span>
                    <div class="input-group-append">
                      <span class="input-group-text" onclick="password_show_hide();">
                        <i class="fas fa-eye" id="show_eye"></i>
                        <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
      </div>
    </div>
  </div>
{{-- EndModalTambah --}}
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
        function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
        }
    </script>
    @endonce
@endpush
