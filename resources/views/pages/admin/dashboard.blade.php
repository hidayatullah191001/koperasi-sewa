@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="avatar-lg rounded-circle bg-soft-pink border-pink border">
                                    <i class="fe-heart font-22 avatar-title text-pink"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1">Rp<span data-plugin="counterup">{{ $totalRevenue }}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Pendapatan Bulan Ini</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-blue border-blue border">
                                    <i class="fe-shopping-cart font-22 avatar-title text-blue"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $todaySales }}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Penjualan hari ini</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                    <i class="fe-bar-chart-line- font-22 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ count($customers) }}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Jumlah Customer</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="widget-rounded-circle card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                    <i class="fe-eye font-22 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ count($drivers) }}</span>
                                    </h3>
                                    <p class="text-muted mb-1 text-truncate">Jumlah Driver</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div>
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row m-0">
            <div class="col-lg-7 col-md-6">
                <div class="card">
                    <div class="card-body pb-2">
                        <h4 class="header-title mb-3">Analisis Penjualan</h4>
                        <div dir="ltr">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div> <!-- end card -->
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title mb-3">Transaksi Terakhir</h4>

                        <div class="table-responsive">
                            <table class="table table-borderless table-nowrap table-hover table-centered m-0">

                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal Transaksi</th>
                                        <th>Pembayaran</th>
                                        <th>Nama Penumpang</th>
                                        <th>Dibuat pada</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lastTransaction as $item)
                                        <tr>
                                            <td><h5 class="m-0 fw-normal">{{ MyHelpers::ubahFormatTanggal($item->tanggal_transaksi) }}</h5></td>
                                            <td>{{ $item->pembayaran }}</td>
                                            <td>{{ $item->customer->nama }}</td>
                                            <td>{{ MyHelpers::ubahFormatTimestamp($item->created_at) }}</td>
                                            <td>
                                                <a href="{{ route('transaction.show', MyHelpers::encode($item->id)) }}" class="btn btn-xs btn-success"><i
                                                        class="fas fa-fw fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div> <!-- end .table-responsive-->
                    </div>
                </div> <!-- end card-->
            </div>
        </div>
    </div> <!-- container -->
@endsection

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: 'Monthly Revenue',
                    data: {!! json_encode($chartData) !!}
                }],
                xaxis: {
                    type: 'datetime',
                    categories: {!! json_encode($chartCategories) !!}
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return 'Rp ' + Intl.NumberFormat().format(value);
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>
@endpush
