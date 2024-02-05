@extends('layouts.index')

@section('content')
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-header-title">
                    <h4 class="pull-left page-title">Data Penghuni</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ route('dashboard') }}"> Dashboard</a></li>
                        <li><a href="{{ route('penghuni.index') }}">Data Penghuni</a></li>
                        <li class="active">Penghuni {{ $penghuni->nama }}</a></li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informasi Penghuni</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-4">
                            <div class="panel">
                                <div class="panel-body user-card">
                                    <div class="media-main"> <a class="pull-left" href="#"> <img
                                                class="thumb-lg img-circle"
                                                src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt=""> </a>
                                        <div class="info">
                                            <h4>{{ $penghuni->nama }}</h4>
                                            <p class="text-muted">Kode: {{ $penghuni->code }}</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <table class="table table-striped table-bordered dt-responsive nowrap"
                                        style="width: 100%; margin-top: 3%">
                                        <tbody>
                                            <tr>
                                                <th>Alamat</th>
                                                <th class="text-right">
                                                    {{ $penghuni->tower }} / lt. {{ $penghuni->lantai }} / room.
                                                    {{ $penghuni->room }}</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Agama
                                                </th>
                                                <th class="text-right">{{ $penghuni->agama }}</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Tempat tanggal lahir
                                                </th>
                                                <th class="text-right">
                                                    {{ $penghuni->tmpt_lahir }} / {{ $penghuni->tgl_lahir }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <th>
                                                    @if ($penghuni->status)
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Non-Aktif</span>
                                                    @endif
                                                    @if ($penghuni->status_pemilik)
                                                        <span class="badge badge-success">Pemilik</span>
                                                    @else
                                                        <span class="badge badge-info">Penyewa</span>
                                                    @endif
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <ul class="social-links list-inline m-b-0">
                                        <li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips"
                                                href="" data-original-title="1234567890"><i
                                                    class="fa fa-phone"></i></a></li>
                                        <li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips"
                                                href="" data-original-title="email@email.com"><i
                                                    class="fa fa-envelope-o"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h4>Informasi Penghuni <span class="text-danger" id="ubahData" role="button"><i
                                        class="fa fa-edit"></i></span>
                            </h4>
                            <form id="saveData">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" value="{{ $penghuni->getuser->username }}"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Code</label>
                                    <input type="text" class="form-control" value="{{ $penghuni->code }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" value="{{ $penghuni->nama }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" value="{{ $penghuni->getuser->email }}"
                                        disabled>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tempat Lahir</label>
                                            <input type="text" class="form-control" value="{{ $penghuni->tmpt_lahir }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tgl Lahir</label>
                                            <input type="date" class="form-control" value="{{ $penghuni->tgl_lahir }}"
                                                disabled>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-info" id="simpan" style="display: none;">Simpan</button>
                                <button class="btn btn-danger" id="batal" style="display: none;">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- End Row -->


    </div>
@endsection

@section('js')
    <script>
        $('#ubahData').click(function() {
            $('#simpan').show();
            $('#batal').show();
            $('input').prop("disabled", false);
        })

        $('#batal').click(function() {
            $('#simpan').hide();
            $('#batal').hide();
            $('input').prop("disabled", true);
        })
    </script>
@endsection
