@extends('layouts.index')

@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Dashboard</h4>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12" style="margin-bottom: 2%;">

                <img src="assets/images/slide-02.jpeg" alt="" width="100%" height="400px"
                    style="background-size: cover; border-radius: 1%;">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="panel panel-warning text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title" style="color: #fff;">Penghuni</h4>
                    </div>
                    <div class="panel-body">
                        <h3 class="">{{ $tp }}</h3>
                        <p class="text-muted">Total Penghuni <br><a href="{{ route('penghuni.index') }}"><i
                                    class="ti-arrow-right"></i> List
                                Penghuni</a></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="panel panel-warning text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title" style="color: #fff;">Available Parking Member</h4>
                    </div>
                    <div class="panel-body">
                        <h3 class=""><b>{{ $tparkir }}</b></h3>
                        <p class="text-muted">Total Parkir Terisi <br><a href="{{ route('parkir.index') }}"><i
                                    class="ti-arrow-right"></i>
                                List Parkiran</a></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="panel panel-warning text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title" style="color: #fff;">Transaksi IPL</h4>
                    </div>
                    <div class="panel-body">
                        <h3 class="">Rp. 1.382.750.000</h3>
                        <p class="text-muted">Update Transaksi IPL - 1 Feb 2024 <br> <a href="transaksi.html"><i
                                    class="ti-arrow-right"></i>List IPL</a></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="panel panel-warning text-center">
                    <div class="panel-heading">
                        <h4 class="panel-title" style="color: #fff;">Revenue Share PPOB</h4>
                    </div>
                    <div class="panel-body">
                        <h3 class="">Rp. 2.382.980.500</h3>
                        <p class="text-muted">Total Revenue PPOB <br> <a href="transaksi.html"><i
                                    class="ti-arrow-right"></i> List Transaksi</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-border panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Grafik Penghuni</h3>
                    </div>
                    <div class="panel-body">
                        <div id="main" style="width: 600px;height:400px;"></div>
                    </div>
                </div>
            </div>

            <!--  Line Chart -->
            <div class="col-lg-6">
                <div class="panel panel-border panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Grafik Parkir Per/Tower</h3>
                    </div>
                    <div class="panel-body">
                        <div id="main1" style="width: 600px;height:400px;"></div>
                    </div>
                </div>
            </div> <!-- col -->
        </div> <!-- End row-->


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Riwayat Transaksi</h3>
                    </div>
                    <div class="panel-body">
                        <table id="table1" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Kode Penghuni</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Keterangan</th>
                                    <th>Tgl. Transaksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div> <!-- End Row -->


    </div>
@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

    <script type="text/javascript">
        var table, tabledata, table_index;

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-Token": $("meta[name=csrf-token]").attr("content")
                }
            });

            table = $('#table1').DataTable({
                fixedColumns: {
                    left: 2
                },
                "pageLength": "10",
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                "ajax": {
                    "url": "{{ route('dashboard.getdata.history') }}",
                    "dataType": "json",
                    "type": "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                    }
                },
                "columns": [{
                        "data": "code"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "alamat"
                    },
                    {
                        "data": "description"
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "status"
                    },
                ],
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari data",
                    emptyTable: "Belum ada data",
                    info: "Menampilkan data _START_ sampai _END_ dari _MAX_ data.",
                    infoEmpty: "Menampilkan 0 sampai 0 dari 0 data.",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    loadingRecords: "Loading...",
                    processing: "Mencari...",
                    paginate: {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Sesudah",
                        "previous": "Sebelum"
                    },
                },
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            orthogonal: 'export'
                        },
                        header: true,
                        footer: true,
                        className: 'btn bg-default text-black',
                    },

                ]
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/datachart')
                .then(response => response.json())
                .then(data => {
                    renderChart(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

            fetch('/datachartpie')
                .then(response => response.json())
                .then(data => {
                    renderChartPie(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        function renderChart(data) {
            const chart = echarts.init(document.getElementById('main'));

            const options = {
                tooltip: {},
                legend: {
                    data: ['Apartment Sentra Timur']
                },
                xAxis: {
                    type: 'category',
                    data: data.map(entry => entry.nama)
                },
                yAxis: {},
                series: [{
                    name: 'Apartment Sentra Timur',
                    data: data.map(entry => entry.total_penghuni),
                    type: 'bar'
                }]
            };

            chart.setOption(options);
        }

        function renderChartPie(data) {
            console.log(data);
            const chart = echarts.init(document.getElementById('main1'));

            const options = {
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 2
                    },
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: 40,
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: data.map(entry => ({
                        name: entry.nama,
                        value: entry.value
                    }))
                }]
            };

            chart.setOption(options);
        }
    </script>
@endsection
