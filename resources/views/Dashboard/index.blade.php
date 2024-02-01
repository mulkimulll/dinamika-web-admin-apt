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
                        <h3 class="">734</h3>
                        <p class="text-muted">Total Penghuni <br><a href="penghuni.html"><i class="ti-arrow-right"></i> List
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
                        <h3 class=""><b>100+</b></h3>
                        <p class="text-muted">Total Parkir Terisi <br><a href="parking.html"><i class="ti-arrow-right"></i>
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
                        <!-- <div id="morris-line-example" style="height: 300px"></div> -->
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
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
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
                                <tr>
                                    <td>00001</td>
                                    <td>Sahidi</td>
                                    <td>Tower B, lt. 20, room 001</td>
                                    <td>Pembayaran IPL</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00001</td>
                                    <td>Sahidi</td>
                                    <td>Tower B, lt. 20, room 001</td>
                                    <td>Pembayaran Air</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00002</td>
                                    <td>Andy</td>
                                    <td>Tower B, lt. 20, room 002</td>
                                    <td>Pembayaran IPL</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00002</td>
                                    <td>Andy</td>
                                    <td>Tower B, lt. 20, room 002</td>
                                    <td>Pembayaran Air</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00003</td>
                                    <td>Adul</td>
                                    <td>Tower B, lt. 1, room 001</td>
                                    <td>Pembayaran IPL</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00003</td>
                                    <td>Adul</td>
                                    <td>Tower B, lt. 1, room 001</td>
                                    <td>Pembayaran Air</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00004</td>
                                    <td>Bedu</td>
                                    <td>Tower B, lt. 1 room 002</td>
                                    <td>Pembayaran IPL</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00004</td>
                                    <td>Bedu</td>
                                    <td>Tower B, lt. 1 room 002</td>
                                    <td>Pembayaran Air</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00005</td>
                                    <td>Burhan</td>
                                    <td>Tower B, lt. 2 room 001</td>
                                    <td>Pembayaran IPL</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00005</td>
                                    <td>Burhan</td>
                                    <td>Tower B, lt. 2 room 001</td>
                                    <td>Pembayaran Air</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00006</td>
                                    <td>Alex</td>
                                    <td>Tower B, lt. 22 room 001</td>
                                    <td>Pembayaran IPL</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td>00006</td>
                                    <td>Alex</td>
                                    <td>Tower B, lt. 22 room 001</td>
                                    <td>Pembayaran Air</td>
                                    <td>10-12-2023</td>
                                    <td><span class="badge badge-success">Sukses</span></td>
                                </tr>
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
        // Initialize the echarts instance based on the prepared dom
        var penghuniChart = echarts.init(document.getElementById('main'));
        var parkirChart = echarts.init(document.getElementById('main1'));

        // Specify the configuration items and data for the chart
        var dataPenghuni = {
            tooltip: {},
            legend: {
                data: ['Appartment Bintaro']
            },
            xAxis: {
                data: ['Tower A', 'Tower B', 'Tower C', 'Tower D', 'Tower E']
            },
            yAxis: {},
            series: [{
                name: 'Appartment Bintaro',
                type: 'bar',
                data: [5, 20, 36, 10, 10]
            }]
        };

        dataParkir = {
            tooltip: {
                trigger: 'item'
            },
            legend: {
                top: '5%',
                left: 'center'
            },
            series: [{
                name: 'Access From',
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
                data: [{
                        value: 1048,
                        name: 'Tower A'
                    },
                    {
                        value: 735,
                        name: 'Tower B'
                    },
                    {
                        value: 580,
                        name: 'Tower C'
                    },
                    {
                        value: 484,
                        name: 'Tower D'
                    },
                    {
                        value: 300,
                        name: 'Tower E'
                    }
                ]
            }]
        };
        // Ukuran grafik akan menyesuaikan dengan lebar kontainer
        window.addEventListener('resize', function() {
            penghuniChart.resize();
        });

        // Display the chart using the configuration items and data just specified.
        penghuniChart.setOption(dataPenghuni);
        parkirChart.setOption(dataParkir);
    </script>
@endsection
