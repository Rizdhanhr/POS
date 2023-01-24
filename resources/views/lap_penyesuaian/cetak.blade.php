<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Font Awesome -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
rel="stylesheet"
/>
<!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<!-- MDB -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
rel="stylesheet"
/>
</head>
<body>
    <div class="card">
        <div class="card-body">
          <div class="container mb-5 mt-3">


            <div class="container">
              <div class="col-md-12">
                <div class="text-center">

                  <h2 class="pt-0">Laporan Penyesuaian</h2>
                </div>

              </div>


              <div class="row">

                <div class="col-xl-4">

                  <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">No Penyesuaian:</span> #{{ $no_penyesuaian }}</li>
                        @foreach($tgl as $t)
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Creation Date: </span>{{ date('d F Y'),strtotime($t->created_at) }}</li>
                        @endforeach
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Status:</span><span class="badge bg-success text-black fw-bold">
                        Sukses</span></li>
                        @foreach($tgl as $t)
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                            class="me-1 fw-bold">Petugas:</span>{{ $t->nama_user }}</li>
                            @endforeach
                  </ul>
                </div>
              </div>

              <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                  <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama Barang</th>
                      <th scope="col">Stok Tercatat</th>
                      <th scope="col">Stok Aktual</th>
                      <th scope="col">Keterangan<th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($cetak as $c)
                    <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $c->nama_barang }}</td>
                      <td>{{ $c->stok_tercatat }}</td>
                      <td>{{ $c->stok_aktual }}</td>
                      <td>{{ $c->keterangan }}</td>
                    </tr>
                    @endforeach
                  </tbody>

                </table>
              </div>

              </div>
              <hr>

              <div class="col-xl-8">

                <p class="ms-3">Catatan :</p>
                @foreach ($catatan as $ct)
                <p class="ms-3">{{ $ct->catatan }}</p>
                @endforeach
              </div>

            </div>
          </div>
        </div>
      </div>

      <script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
></script>

<script>
  window.print();
</script>
</body>
</html>
