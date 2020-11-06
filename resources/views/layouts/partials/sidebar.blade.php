<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <!-- Dashboard sementara untuk cabang, pemilik, pengelola -->
  <li class="nav-item nav-cabang nav-pemilik nav-pengelola {{ (Request::segment(1)=='dashboard')?'active':'' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  {{-- <div class="sidebar-heading">
    Data Management
  </div> --}}

  <!-- Kasir start -->
  <li class="nav-item nav-kasir {{ (Request::segment(1)=='kasir'&&Request::segment(2)=='')?'active':'' }}">
    <a class="nav-link" href="{{ route('kasir') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Dashboard</span></a>
  </li>
  <li class="nav-item nav-kasir {{ (Request::segment(2)=='transaksi')?'active':'' }}">
    <a class="nav-link" href="{{ route('kasir.transaksi') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Transaksi</span></a>
  </li>
  <li class="nav-item nav-kasir {{ (Request::segment(2)=='transaksi-pending')?'active':'' }}">
    <a class="nav-link" href="{{ route('kasir.pending') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Transaksi Pending</span></a>
  </li>
  <!-- Kasir end -->

  <!-- Nav Item - Pages Collapse Menu -->
  <!-- UMKM/Cabang start -->
  <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Inventori Produk / Kartu Stok</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('stok') }}">Stok Masuk</a>
        <a class="collapse-item" href="{{ route('stok.opname') }}">Stok Opname</a>
      </div>
    </div>
  </li>
  <li class="nav-item nav-pemilik nav-umkm">
    <a class="nav-link" href="{{ route('cabang.index') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Cabang</span></a>
  </li>
  <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-cog"></i>
      <span>Laporan Penjualan</span></a>
  </li>
  <li class="nav-item nav-cabang nav-pemilik nav-umkm {{ (Request::segment(1)=='karyawan')?'active':'' }}">
    <a class="nav-link" href="{{ route('karyawan.index') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Karyawan</span></a>
  </li>
  <li class="nav-item nav-pemilik nav-umkm">
    <a class="nav-link" href="{{ route('kategori.index') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Kategori Produk</span></a>
  </li>
  <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link" href="{{ route('produk.index') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Produk</span></a>
  </li>
  <li class="nav-item nav-cabang">
    <a class="nav-link" href="{{ route('kasir-cabang.index') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Kasir</span></a>
  </li>
  <!-- <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduk" aria-expanded="true" aria-controls="collapseProduk">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Produk</span>
    </a>
    <div id="collapseProduk" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('kategori.index') }}">Kelola Kategori Produk</a>
        <a class="collapse-item" href="{{ route('produk.index') }}">List Produk</a>
      </div>
    </div>
  </li> -->
  <!-- UMKM/Cabang end -->

  <!-- Pengelola start -->
  <li class="nav-item nav-pengelola">
    <a class="nav-link" href="{{ route('umkm.index') }}">
      <i class="fas fa-fw fa-cog"></i>
      <span>Pendaftaran UMKM</span></a>
  </li>
  <li class="nav-item nav-pengelola">
    <a class="nav-link" href="#">
      <i class="fas fa-fw fa-cog"></i>
      <span>List Transaksi UMKM</span></a>
  </li>
  <li class="nav-item nav-pengelola">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>List Data Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('umkm.data') }}">Data UMKM</a>
        <a class="collapse-item" href="{{ route('umkm.karyawan') }}">Data Karyawan UMKM</a>
        <a class="collapse-item" href="{{ route('umkm.kategori') }}">Kategori UMKM</a>
        <a class="collapse-item" href="#">Data Route Table Kategori</a>
        <a class="collapse-item" href="#">Data Route Table Produk</a>
      </div>
    </div>
  </li>
  <li class="nav-item nav-pengelola">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Data Master</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('users.index') }}">Kelola User</a>
      </div>
    </div>
  </li>
  <!-- Pengelola end -->

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->
