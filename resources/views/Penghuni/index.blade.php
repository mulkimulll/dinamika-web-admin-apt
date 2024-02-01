@extends('layouts.index')

@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Data Penghuni</h4>
                    <ol class="breadcrumb pull-right">
                        <li>Dashboard</li>
                        <li class="active"><a href="#">Data Penghuni</a></li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalPenghuni"><i
                        class="fa fa-plus-circle"></i> Tambah data penghuni</button>
                <hr>
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Table Penghuni</h3>
                    </div>
                    <div class="panel-body">
                        <table id="table1" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Kode Penghuni</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Tgl. Join</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
    <!-- sample modal content -->
    <div id="modalPenghuni" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Penghuni</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tempat lahir</label>
                                <input type="text" class="form-control" placeholder="Tempat lahir">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tgl Lahir</label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telp </label>
                        <input type="text" class="form-control" placeholder="08XXXXXXXX">
                    </div>
                    <div class="form-group">
                        <label for="">Agama </label>
                        <select name="" class="form-control" id="">
                            <option value="">-- Pilih --</option>
                            <option value="">Islam</option>
                            <option value="">Kristen</option>
                            <option value="">Hindu</option>
                            <option value="">Budha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Status Penghuni </label>
                        <select name="" class="form-control" id="">
                            <option value="">-- Pilih --</option>
                            <option value="">Pemilik</option>
                            <option value="">Sewa</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tower</label>
                                <select name="" class="form-control" id="">
                                    <option value="">-- Pilih --</option>
                                    <option value="">A</option>
                                    <option value="">B</option>
                                    <option value="">C</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Lantai</label>
                                <select name="" class="form-control" id="">
                                    <option value="">-- Pilih --</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Room</label>
                                <input type="text" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ktp</label>
                                <input type="text" class="form-control" placeholder="367400XXXXXXXX">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Foto KTP</label>
                                <input type="file" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    <script type="text/javascript">
        var table;
        $(document).ready(function() {
            // $(".btn-refresh").click(function() {
            //     table.ajax.reload();
            // });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-Token": $("meta[name=csrf-token]").attr("content")
                }
            });

            table = $('#table1').DataTable({
                fixedColumns: {
                    left: 2
                },
                "pagingType": "full_numbers",
                "pageLength": 10,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                "select": true,
                "ajax": {
                    "url": "{{ route('penghuni.getdata') }}",
                    "dataType": "json",
                    "type": "POST",
                    data: function(d) {
                        d._token = "{{ csrf_token() }}";
                    }
                },
                "columns": [{
                        "data": "no",
                        "orderable": false,
                    },
                    {
                        "data": "kabupaten"
                    },
                    {
                        "data": "jml_pusk"
                    },
                    {
                        "data": "jml_workshop_assist"
                    },
                    {
                        "data": "layanan_assist"
                    },
                    {
                        "data": "skrinning_assist"
                    },
                    {
                        "data": "peserta_skrinning_tahun"
                    },
                    {
                        "data": "peserta_skrinning_kumulatif"
                    },
                    {
                        "data": "ringan"
                    },
                    {
                        "data": "sedang"
                    },
                    {
                        "data": "berat"
                    },
                    {
                        "data": "ipwl"
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
@endsection
