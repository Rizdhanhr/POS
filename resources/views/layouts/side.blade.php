 <!-- Sidebar Start -->
 <div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>POS</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('template') }}/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>

            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ url('dashboard') }}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Barang</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ route('barang.create') }}" class="dropdown-item">Tambah Barang</a>
                    <a href="{{ url('barang') }}" class="dropdown-item">Data Barang</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-table me-2"></i>Atribut Barang</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ url('kategori') }}" class="dropdown-item">Kategori</a>
                    <a href="{{ url('satuan') }}" class="dropdown-item">Satuan</a>
                    <a href="{{ url('brand') }}" class="dropdown-item">Brand</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-chart-bar me-2"></i>Transaksi</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ url('pembelian') }}" class="dropdown-item">Pembelian</a>
                    <a href="{{ url('penjualan') }}" class="dropdown-item">Penjualan</a>
                    <a href="{{ route('penyesuaian.create') }}" class="dropdown-item">Penyesuaian</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-keyboard me-2"></i>Stok</a>
                <div class="dropdown-menu bg-transparent border-0">
                    {{-- <a href="button.html" class="dropdown-item">Data Stok</a> --}}
                    <a href="{{ url('stok-menipis') }}" class="dropdown-item">Stok Menipis</a>
                    <a href="element.html" class="dropdown-item">Mutasi</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Laporan</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="{{ url('lap-penjualan') }}" class="dropdown-item">Penjualan</a>
                    <a href="{{ url('lap-pembelian') }}" class="dropdown-item">Pembelian</a>
                    <a href="{{ url('lap-penyesuaian') }}" class="dropdown-item">Penyesuaian</a>
                </div>
            </div>
            <a href="{{ url('supplier') }}" class="nav-item nav-link"><i class="fa fa-car me-2"></i>Supplier</a>
            @if(Auth::check() && Auth::user()->level  == "1")

            <a href="{{ url('manajemen-user') }}" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Manajemen User</a>
            @endif

            {{-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Transaksi</a>
            <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
            <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="signin.html" class="dropdown-item">Sign In</a>
                    <a href="signup.html" class="dropdown-item">Sign Up</a>
                    <a href="404.html" class="dropdown-item">404 Error</a>
                    <a href="blank.html" class="dropdown-item">Blank Page</a>
                </div>
            </div> --}}
        </div>
    </nav>
</div>
<!-- Sidebar End -->
