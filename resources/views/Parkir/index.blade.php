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
                    <table id="table1"
                        class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>Kode Penghuni</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tgl. Join</th>
                                <th class="text-center">Merk Mobil / Plat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>

    </div> <!-- End Row -->


</div>
@endsection

@section('js')
<script type="text/javascript">
    var table,tabledata,table_index;
    
    function deleteData(e,code){
            var token = '{{ csrf_token() }}';
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya",
                cancelButtonText:"Batal",
                confirmButtonColor: "#ec6c62",
                closeOnConfirm: false
            }).then(function(result) {
                console.log(result)
                if (result.value) {
                    $.ajaxSetup({
                        headers: { "X-CSRF-Token" : $("meta[name=csrf-token]").attr("content") }
                    });
                    $.ajax({
                        type: 'delete',
                        url: '{{route("penghuni.delete")}}/' + code,
                        headers: {'X-CSRF-TOKEN': token},
                        success: function(data){
                        console.log(data)
                        if (data.status == 'success') {
                            Swal.fire('Yes',data.message,'success');
                            table.ajax.reload(null, true);
                        }else{
                            Swal.fire('Ups',data.message,'info');
                        }
                    },
                    error: function(data){
                        console.log(data);
                        Swal.fire("Ups!", "Terjadi kesalahan pada sistem.", "error");
                    }});
                }
            });
        }

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
                "url": "{{ route('penghuni.getdata') }}",
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
                    "data": "created_at"
                },
                {
                    "data": "status"
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
                var files = $('#foto_ktp')[0].files;
                var dataFile = new FormData()

                dataFile.append('file',files[0]);

                $.each(form, function(idx, val) {
                    dataFile.append(val.name, val.value)
                })
            $.ajax({
                type: 'POST',
                url : "{{route('penghuni.add')}}",
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                data:dataFile,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function () {
                    Swal.showLoading();
                },
                success: function(data){
                    console.log(data);
                    if (data.success) {
                        Swal.fire('Yes',data.message,'info');
                        window.location.replace('{{route("penghuni.index")}}');
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
                    console.log(data);
                    $('#simpan').removeClass("disabled");
                    Swal.hideLoading();
                    Swal.fire('Ups','Ada kesalahan pada sistem','info');
                }
            });
        });
    });

</script>
@endsection