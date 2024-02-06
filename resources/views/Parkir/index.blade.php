@extends('layouts.index')

@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Data Parkir Kendaraan</h4>
                    <ol class="breadcrumb pull-right">
                        <li>Dashboard</li>
                        <li class="active"><a href="#">Data Parkir Kendaraan</a></li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalPenghuni"><i
                        class="fa fa-plus-circle"></i> Tambah data kendaraan</button>
                <hr>
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Table Parkir Kendaraan</h3>
                    </div>
                    <div class="panel-body">
                        <table id="table1" class="table table-striped table-bordered dt-responsive nowrap"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama /Kode Penghuni</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kendaraan</th>
                                    <th class="text-center">Merk Mobil / Plat</th>
                                    <th>Status</th>
                                    <th>Aktif S/d </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div> <!-- End Row -->


    </div>

    <div id="modalPenghuni" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Parkir</h4>
                </div>
                <div class="modal-body">
                    <form id="saveDataForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="">Nama Penghuni</label>
                            <select name="user_id" id="select2" style="width: 100%" required>
                                @foreach ($penghuni as $item)
                                    <option value="{{ $item->user_id }}">{{ $item->nama }} - {{ $item->code }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Jenis Kendaraan </label>
                            <select name="jns_kendaraan" id="jns_kendaraan" class="form-control" required>
                                <option value="motor">Motor</option>
                                <option value="mobil">Mobil</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Plat Nomor</label>
                                    <input name="plat_nomor" type="text" class="form-control" placeholder="B 1234 A"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Foto STNK</label>
                                    <input name="foto_stnk" id="foto_stnk" type="file" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Aktif s/d </label>
                            <input name="tgl_nonaktif" type="date" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="button" id="simpan" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    <script type="text/javascript">
        var table, tabledata, table_index;

        function deleteData(e, code) {
            var token = '{{ csrf_token() }}';
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal",
                confirmButtonColor: "#ec6c62",
                closeOnConfirm: false
            }).then(function(result) {
                console.log(result)
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-Token": $("meta[name=csrf-token]").attr("content")
                        }
                    });
                    $.ajax({
                        type: 'delete',
                        url: '{{ route('parkir.delete') }}/' + code,
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(data) {
                            console.log(data)
                            if (data.status == 'success') {
                                Swal.fire('Yes', data.message, 'success');
                                table.ajax.reload(null, true);
                            } else {
                                Swal.fire('Ups', data.message, 'info');
                            }
                        },
                        error: function(data) {
                            console.log(data);
                            Swal.fire("Ups!", "Terjadi kesalahan pada sistem.", "error");
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#select2').select2();
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
                "pageLength": "10",
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                "ajax": {
                    "url": "{{ route('parkir.getdata') }}",
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
                        "data": "alamat"
                    },
                    {
                        "data": "jns_kendaraan"
                    },
                    {
                        "data": "merk",
                        "className": "text-center"
                    },
                    {
                        "data": "aktif"
                    },
                    {
                        "data": "status",
                        "className": "text-center"
                    },
                    {
                        "data": "action"
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

            $("#simpan").on('click', function() {
                $('#simpan').addClass("disabled");
                var form = $('#saveDataForm').serializeArray()
                var files = $('#foto_stnk')[0].files;
                var dataFile = new FormData()

                dataFile.append('file', files[0]);

                $.each(form, function(idx, val) {
                    dataFile.append(val.name, val.value)
                })
                $.ajax({
                    type: 'POST',
                    url: "{{ route('parkir.add') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                    },
                    data: dataFile,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            Swal.fire('Yes', data.message, 'info');
                            window.location.replace('{{ route('parkir.index') }}');
                        } else {
                            Swal.fire('Ups', data.message, 'info');
                        }
                        Swal.hideLoading();
                    },
                    complete: function() {
                        Swal.hideLoading();
                        $('#simpan').removeClass("disabled");
                    },
                    error: function(data) {
                        console.log(data);
                        $('#simpan').removeClass("disabled");
                        Swal.hideLoading();
                        Swal.fire('Ups', 'Ada kesalahan pada sistem', 'info');
                    }
                });
            });
        });
    </script>
@endsection
