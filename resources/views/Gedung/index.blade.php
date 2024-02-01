@extends('layouts.index')

@section('content')
<div class="container">

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header-title">
                <h4 class="pull-left page-title">Master Data gedung</h4>
                <ol class="breadcrumb pull-right">
                    <li>Dashboard</li>
                    <li class="active"><a href="#">Master Data gedung</a></li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalPenghuni"><i
                    class="fa fa-plus-circle"></i> Tambah Master Data gedung</button>
            <hr>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Table Gedung</h3>
                </div>
                <div class="panel-body">
                    <table id="table1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>Kode Gedung</th>
                                <th>Nama</th>
                                <th>Total Lt/Room</th>
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

    <!-- sample modal content -->
    <div id="modalPenghuni" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Tambah Data Gedung</h4>
                </div>
                <div class="modal-body">
                    <form id="saveDataForm" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="">Kode Gedung</label>
                            <input type="text" class="form-control" name="code" placeholder="Masukkan Kode Gedung">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Gedung</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Gedung">
                        </div>
                        <div class="form-group">
                            <label for="">Total Lantai</label>
                            <input type="number" class="form-control" name="lantai" placeholder="Masukkan Total Lantai">
                        </div>
                        <div class="form-group">
                            <label for="">Total Room </label>
                            <input type="number" class="form-control" name="room" placeholder="Masukkan Total Room">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" id="simpan" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
@endsection

@section('js')
<script type="text/javascript">
    var table,tabledata,table_index;
    $(document).ready(function () {
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
                "url": "{{ route('gedung.getdata') }}",
                "dataType": "json",
                "type": "POST",
                data: function (d) {
                    d._token = "{{ csrf_token() }}";
                }
            },
            "columns": [
                {
                    "data": "code"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "alamat"
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

        $("#simpan").on('click',function(){
            $('#simpan').addClass("disabled");
                var form = $('#saveDataForm').serializeArray()
                var dataFile = new FormData()

                $.each(form, function(idx, val) {
                    dataFile.append(val.name, val.value)
                })
            $.ajax({
                type: 'POST',
                url : "{{route('gedung.add')}}",
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                data:dataFile,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function () {
                    Swal.showLoading();
                },
                success: function(data){
                    if (data.success) {
                        Swal.fire('Yes',data.message,'info');
                        window.location.replace('{{route("gedung.index")}}');
                    } else {
                        Swal.fire('Ups',data.message,'info');
                    }
                    Swal.hideLoading();
                },
                complete: function () {
                    Swal.hideLoading();
                    $('#simpan').removeClass("disabled");
                },
                error: function(data){
                    $('#simpan').removeClass("disabled");
                    Swal.hideLoading();
                    Swal.fire('Ups','Ada kesalahan pada sistem','info');
                    console.log(data);
                }
            });
        });
    });

</script>
@endsection
