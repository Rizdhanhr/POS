@extends('layouts.app1')
@section('title','Dashboard')
@push('css')
    @once
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    @endonce
@endpush
@section('content')
  <!-- Sale & Revenue Start -->
  <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-solid fa-book  fa-3x text-primary"></i>

                <div class="ms-3">
                    <p class="mb-2">Total Barang</p>
                    <h6 class="mb-0">{{ $barang }}</h6>
                </div>

            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-bar fa-3x text-primary"></i>
                <div class="ms-2">
                    <p class="mb-2">Minggu Ini</p>
                    <h6 class="mb-0">@currency($thisweek)</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-area fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Hari ini</p>
                    <h6 class="mb-0">@currency($thisday)</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Terjual bulan ini</p>
                    <h6 class="mb-0">{{ $sold }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->


<!-- Sales Chart Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Transaksi Tahun Ini</h6>
                    <a href="">Show All</a>
                </div>
                <canvas id="worldwide-sales"></canvas>
                {{-- <canvas id="myChart"></canvas> --}}
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Pemasukan Tahun Ini</h6>
                    <a href="">Show All</a>
                </div>
                <canvas id="salse-revenue"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Sales Chart End -->


<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Recent Salse</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
                        <th scope="col">Date</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input class="form-check-input" type="checkbox"></td>
                        <td>01 Jan 2045</td>
                        <td>INV-0123</td>
                        <td>Jhon Doe</td>
                        <td>$123</td>
                        <td>Paid</td>
                        <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="checkbox"></td>
                        <td>01 Jan 2045</td>
                        <td>INV-0123</td>
                        <td>Jhon Doe</td>
                        <td>$123</td>
                        <td>Paid</td>
                        <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="checkbox"></td>
                        <td>01 Jan 2045</td>
                        <td>INV-0123</td>
                        <td>Jhon Doe</td>
                        <td>$123</td>
                        <td>Paid</td>
                        <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="checkbox"></td>
                        <td>01 Jan 2045</td>
                        <td>INV-0123</td>
                        <td>Jhon Doe</td>
                        <td>$123</td>
                        <td>Paid</td>
                        <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                    </tr>
                    <tr>
                        <td><input class="form-check-input" type="checkbox"></td>
                        <td>01 Jan 2045</td>
                        <td>INV-0123</td>
                        <td>Jhon Doe</td>
                        <td>$123</td>
                        <td>Paid</td>
                        <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->


<!-- Widgets Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Calender</h6>
                    <a href="">Show All</a>
                </div>
                <div id="calender"></div>
            </div>
        </div>
        <div id="table-posts" class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">To Do List</h6>
                    <a href="">Show All</a>
                </div>

                <div class="d-flex mb-2">
                    <input class="form-control bg-transparent" type="text" name="nama" id="nama" placeholder="Enter task">
                    <button type="button" class="btn btn-primary ms-2 add_todo"  >Add</button>
                </div>

                @foreach ($todolist as $todo)
                <div id="index_{{ $todo->id }}" class="d-flex align-items-center border-bottom py-2">
                    <div class="w-100 ms-3">
                        <div  class="d-flex w-100 align-items-center justify-content-between">
                            <span>{{ $todo->nama }}</span>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="{{ $todo->id }}" class="btn btn-sm"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Widgets End -->

@endsection
@push('script')
    @once
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   <script>
    var ctx1 = $("#worldwide-sales").get(0).getContext("2d");
    var myChart1 = new Chart(ctx1, {
        type: "bar",
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli","Agustus",
            "September", "Oktober","November","Desember"],
            datasets: [{
                    label: "Penjualan",
                    data: [{{ $pj_jan }}, {{ $pj_feb }}, {{ $pj_mar }}, {{ $pj_apr }}, {{ $pj_mei }}
                    , {{ $pj_jun }},{{ $pj_jul }}, {{ $pj_agu }},{{ $pj_sep }},{{ $pj_okt }},{{ $pj_nov }},{{ $pj_des }}],
                    backgroundColor: "rgba(0, 156, 255, .7)"
                },
                {
                    label: "Pembelian",
                    data: [{{ $pb_jan }}, {{ $pb_feb }}, {{ $pb_mar }}, {{ $pb_apr }}, {{ $pb_mei }}
                    , {{ $pb_jun }},{{ $pb_jul }}, {{ $pb_agu }},{{ $pb_sep }},{{ $pb_okt }},{{ $pb_nov }},{{ $pb_des }}],
                    backgroundColor: "rgb( 255, 0, .0)"
                }
            ]
            },
        options: {
            responsive: true
        }
    });


    var ctx2 = $("#salse-revenue").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli","Agustus",
            "September", "Oktober","November","Desember"],
            datasets: [{
                    label: "Pemasukan",
                    data: [{{ $pm_jan }}, {{ $pm_feb }}, {{ $pm_mar }}, {{ $pm_apr }}, {{ $pm_mei }}
                    , {{ $pm_jun }},{{ $pm_jul }}, {{ $pm_agu }},{{ $pm_sep }},{{ $pm_okt }},{{ $pm_nov }},{{ $pm_des }}],
                    backgroundColor: "rgba(0, 156, 255, .7)",
                    fill: true
                },
                {
                    label: "Pengeluaran",
                    data: [{{ $pr_jan }}, {{ $pr_feb }}, {{ $pr_mar }}, {{ $pr_apr }}, {{ $pr_mei }}
                    , {{ $pr_jun }},{{ $pr_jul }}, {{ $pr_agu }},{{ $pr_sep }},{{ $pr_okt }},{{ $pr_nov }},{{ $pr_des }}],
                    backgroundColor: "rgb( 255, 0, .0)",
                    fill: true
                }
            ]
            },
        options: {
            responsive: true
        }
    });




    $(document).ready(function () {
        $(document).on('click','.add_todo',function (e) {
            e.preventDefault();

            var data = {
                'nama' : $('#nama').val(),
            }

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $.ajax({
                type : "POST",
                url : "{{ route('dashboard.store') }}",
                data : data,
                dataType : "json",
                success : function (response){
                    let todo = `
                    <div id="index_${response.data.id}" class="d-flex align-items-center border-bottom py-2">
                    <div class="w-100 ms-3">
                        <div  class="d-flex w-100 align-items-center justify-content-between">
                            <span>${response.data.nama}</span>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-sm"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                   </div>
                 `;
                 $('#table-posts').append(todo);
                 $('#nama').val('');
                }
            });
        });
    });



   </script>
    @endonce
@endpush
