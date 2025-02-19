@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mt-2 mb-4">
        <h4><i class="icon-dashboard me-1"></i> Dashboard</h4>
        <div class="btn btn-primary font-monospace fs-7 fw-bold"> <i class="fa-solid fa-calendar-day me-1"></i>
            {{ date('j F Y') }}</div>
    </div>
    <div class="row g-4">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-dashboard">
                <div class="card-body bg-info d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h6 class="card-title">Storage</h6>
                        <h4>{{$ruang}}</h4>
                        <small>Ruang Penyimpanan</small>
                    </div>
                    <i class="fa-brands fa-dropbox"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-dashboard">
                <div class="card-body bg-warning d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h6 class="card-title">Dokumen</h6>
                        <h4>{{ $dokumen }}</h4>
                        <small>Total Dokumen</small>
                    </div>
                    <i class="bi bi-folder-fill"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-dashboard">
                <div class="card-body bg-danger d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h6 class="card-title">User Peminjam</h6>
                        <h4>10</h4>
                        <small>{{ $user }}</small>
                    </div>
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-dashboard">
                <div class="card-body bg-success d-flex justify-content-between align-items-center text-white">
                    <div>
                        <h6 class="card-title">Peminjaman</h6>
                        <h4>{{ $transaksi }}</h4>
                        <small>Transaksi Pinjaman</small>
                    </div>
                    <i class="bi bi-card-checklist"></i>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-4 mb-5">
    <div class="bg-white shadow">
        <div class="table-wrapper">
            <div class="bg-black px-4 mb-4" style="padding: 10px">
                <div class="row">
                    <div class="col-sm-4 text-white fs-8">
                        <i class="fa-solid fa-chart-column me-3" style="color:orange"></i><b>Statistika Ruang
                            Penyimpanan</b>
                    </div>
                </div>
            </div>
            <div class="diagram-chart">
                <script src="{{ asset('/chart/highcharts.js') }}"></script>
                <script src="{{ asset('/chart/modules/exporting.js') }}"></script>
                <script src="{{ asset('/chart/modules/export-data.js') }}"></script>
                <script src="{{ asset('/chart/modules/accessibility.js') }}"></script>
                <figure class="highcharts-figure">
                    <div id="container" class="pe-4"></div>
                </figure>
                <script type="text/javascript">
                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Statistika Penyimpanan'
                        },
                        xAxis: {
                            categories: ['Ruang'],
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            title: {
                                useHTML: true,
                                text: 'Jumlah'
                            }
                        },
                        tooltip: {
                            valueSuffix: ''
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },

                        credits: {
                            enabled: false
                        },

                        series: [
                            @foreach ($cart as $r)
                            {
                                name : '{{$r->cart}}',
                                data: [{{ $r->dokumen_count }}]
                            },
                            @endforeach
                        ]

                    });
                </script>
            </div>
        </div>
    </div>
@endsection
