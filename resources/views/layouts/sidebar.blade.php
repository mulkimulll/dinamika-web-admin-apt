<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="text-center">
                <img src="assets/images/logo.png" alt="" class="img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="{{ route('dashboard') }}" class="dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">Admin</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('logout') }}"> Logout</a></li>
                    </ul>
                </div>

                <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect"><i class="ti-home"></i><span> Dashboard
                        </span></a>
                </li>

                <li>
                    <a href="{{ route('penghuni.index') }}" class="waves-effect"><i class="ti-user"></i><span> Penghuni
                        </span></a>
                </li>

                <li>
                    <a href="{{ route('parkir.index') }}" class="waves-effect"><i class="ti-car"></i><span> Parkir
                            Kendaraan
                        </span></a>
                </li>

                <li>
                    <a href="transaksi.html" class="waves-effect"><i class="ti-wallet"></i><span> Transaksi
                        </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-agenda"></i> <span> Master
                            Data </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('gedung.index') }}">Gedung / Tower</a></li>
                        <li><a href="{{ route('parkir.member.index') }}">Member parkir</a></li>
                        <li><a href="master-ipl.html">IPL</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('pengaduan.index') }}" class="waves-effect"><i class="ti-wallet"></i><span>
                            Pengaduan
                        </span></a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
