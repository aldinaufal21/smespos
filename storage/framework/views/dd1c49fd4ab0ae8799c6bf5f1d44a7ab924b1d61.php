<!-- Sidebar -->
<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" style="background-color: #FE914A;" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('dashboard')); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <img src="<?php echo e(asset('img/logo1.png')); ?>" width="30" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">SmesPos.id</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <!-- Dashboard sementara untuk cabang, pemilik, pengelola -->
  <li class="nav-item nav-cabang nav-pemilik nav-pengelola nav-umkm <?php echo e((Request::segment(1)=='dashboard')?'active':''); ?>">
    <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  

  <!-- Kasir start -->
  <li class="nav-item nav-kasir <?php echo e((Request::segment(2)=='kasir'&&Request::segment(3)=='')?'active':''); ?>">
    <a class="nav-link" href="<?php echo e(route('kasir')); ?>">
      <i class="fas fa-fw fa-cog"></i>
      <span>Dashboard</span></a>
  </li>
  <li class="nav-item nav-kasir <?php echo e((Request::segment(3)=='transaksi')?'active':''); ?>">
    <a class="nav-link" href="<?php echo e(route('kasir.transaksi')); ?>">
      <i class="fas fa-fw fa-credit-card"></i>
      <span>Kasir</span></a>
  </li>
  <li class="nav-item nav-kasir <?php echo e((Request::segment(3)=='transaksi-pending')?'active':''); ?>">
    <a class="nav-link" href="<?php echo e(route('kasir.pending')); ?>">
      <i class="fas fa-fw fa-credit-card"></i>
      <span>Transaksi Pending</span></a>
  </li>
  <li class="nav-item nav-kasir <?php echo e((Request::segment(3)=='transaksi-harian')?'active':''); ?>">
    <a class="nav-link" href="<?php echo e(route('kasir.daily')); ?>">
      <i class="fas fa-fw fa-credit-card"></i>
      <span>List Transaksi Harian</span></a>
  </li>
  <li class="nav-item nav-kasir <?php echo e((Request::segment(3)=='laporan')?'active':''); ?>">
    <a class="nav-link" href="<?php echo e(route('kasir.report')); ?>">
      <i class="fas fa-fw fa-credit-card"></i>
      <span>Laporan Penjualan</span></a>
  </li>
  <!-- Kasir end -->

  <!-- Nav Item - Pages Collapse Menu -->
  <!-- UMKM/Cabang start -->
  <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fas fa-fw fa-book"></i>
      <span>Kelola Inventori Produk / Kartu Stok</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('stok')); ?>">Stok Masuk</a>
        <a class="collapse-item" href="<?php echo e(route('stok.opname')); ?>">Stok Opname</a>
      </div>
    </div>
  </li>
  <li class="nav-item nav-pemilik nav-umkm">
    <a class="nav-link" href="<?php echo e(route('cabang.index')); ?>">
      <i class="fas fa-fw fa-university"></i>
      <span>Kelola Cabang</span></a>
  </li>
  <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link" href="<?php echo e(route('report.sales')); ?>">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Laporan Penjualan Online</span></a>
  </li>
  <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link link-cabang-id">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Laporan Penjualan Kasir</span></a>
  </li>
  <li class="nav-item nav-cabang nav-pemilik nav-umkm <?php echo e((Request::segment(1)=='karyawan')?'active':''); ?>">
    <a class="nav-link" href="<?php echo e(route('karyawan.index')); ?>">
      <i class="fas fa-fw fa-users"></i>
      <span>Kelola Karyawan</span></a>
  </li>
  <li class="nav-item nav-pemilik nav-umkm">
    <a class="nav-link" href="<?php echo e(route('kategori.index')); ?>">
      <i class="fas fa-fw fa-tag"></i>
      <span>Kelola Kategori Produk</span></a>
  </li>
  <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link" href="<?php echo e(route('produk.index')); ?>">
      <i class="fas fa-fw fa-archive"></i>
      <span>Kelola Produk</span></a>
  </li>
  <li class="nav-item nav-umkm">
    <a class="nav-link" href="<?php echo e(route('bank.index')); ?>">
      <i class="fas fa-fw fa-credit-card"></i>
      <span>Kelola Bank</span></a>
  </li>
  <li class="nav-item nav-cabang">
    <a class="nav-link" href="<?php echo e(route('kasir-cabang.index')); ?>">
      <i class="fas fa-fw fa-desktop"></i>
      <span>Kelola Kasir</span></a>
  </li>
  <li class="nav-item nav-cabang nav-umkm">
    <a class="nav-link" href="<?php echo e(route('transaksi.index')); ?>">
      <i class="fas fa-fw fa-credit-card"></i>
      <span>Transaksi Konsumen</span></a>
  </li>
  <!-- <li class="nav-item nav-cabang nav-pemilik nav-umkm">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduk" aria-expanded="true" aria-controls="collapseProduk">
      <i class="fas fa-fw fa-cog"></i>
      <span>Kelola Produk</span>
    </a>
    <div id="collapseProduk" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('kategori.index')); ?>">Kelola Kategori Produk</a>
        <a class="collapse-item" href="<?php echo e(route('produk.index')); ?>">List Produk</a>
      </div>
    </div>
  </li> -->
  <!-- UMKM/Cabang end -->

  <!-- Pengelola start -->
  <li class="nav-item nav-pengelola">
    <a class="nav-link" href="<?php echo e(route('umkm.index')); ?>">
      <i class="fas fa-fw fa-address-card"></i>
      <span>Pendaftaran UMKM</span></a>
  </li>
  <li class="nav-item nav-pengelola">
    <a class="nav-link" href="<?php echo e(route('umkm.transaksi')); ?>">
      <i class="fas fa-fw fa-credit-card"></i>
      <span>List Transaksi UMKM</span></a>
  </li>
  <li class="nav-item nav-pengelola">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-database"></i>
      <span>List Data Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('umkm.data')); ?>">Data UMKM</a>
        <a class="collapse-item" href="<?php echo e(route('umkm.karyawan')); ?>">Data Karyawan UMKM</a>
        <a class="collapse-item" href="<?php echo e(route('umkm.kategori')); ?>">Kategori UMKM</a>
        <a class="collapse-item" href="<?php echo e(route('route.kategori')); ?>">Data Route Table Kategori</a>
        <a class="collapse-item" href="<?php echo e(route('route.produk')); ?>">Data Route Table Produk</a>
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
        <a class="collapse-item" href="<?php echo e(route('users.index')); ?>">Kelola User</a>
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
<?php /**PATH /Users/izharauliataqwa/Documents/project/idukafix/resources/views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>