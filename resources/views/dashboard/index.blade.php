@extends('layouts.app1')
@section('title','Dashboard')
@push('css')
    @once

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
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Messages</h6>
                    <a href="">Show All</a>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <small>15 minutes ago</small>
                        </div>
                        <span>Short message goes here...</span>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <small>15 minutes ago</small>
                        </div>
                        <span>Short message goes here...</span>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <small>15 minutes ago</small>
                        </div>
                        <span>Short message goes here...</span>
                    </div>
                </div>
                <div class="d-flex align-items-center pt-3">
                    <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Jhon Doe</h6>
                            <small>15 minutes ago</small>
                        </div>
                        <span>Short message goes here...</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Calender</h6>
                    <a href="">Show All</a>
                </div>
                <div id="calender"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">To Do List</h6>
                    <a href="">Show All</a>
                </div>
                <div class="d-flex mb-2">
                    <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                    <button type="button" class="btn btn-primary ms-2">Add</button>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Short task goes here...</span>
                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Short task goes here...</span>
                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox" checked>
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span><del>Short task goes here...</del></span>
                            <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-2">
                    <input class="form-check-input m-0" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Short task goes here...</span>
                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center pt-2">
                    <input class="form-check-input m-0" type="checkbox">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <span>Short task goes here...</span>
                            <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Widgets End -->

@endsection
@push('script')
    @once
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
            labels: ["Januari", "2017", "2018", "2019", "2020", "2021", "2022"],
            datasets: [{
                    label: "Pemasukan",
                    data: [15, 30, 55, 45, 70, 65, 85],
                    backgroundColor: "rgba(0, 156, 255, .5)",
                    fill: true
                },
                {
                    label: "Revenue",
                    data: [99, 135, 170, 130, 190, 180, 270],
                    backgroundColor: "rgba(0, 156, 255, .3)",
                    fill: true
                }
            ]
            },
        options: {
            responsive: true
        }
    });

   </script>
    @endonce
@endpush
