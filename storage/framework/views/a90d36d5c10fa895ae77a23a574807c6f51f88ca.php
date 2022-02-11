<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Karyawan UMKM</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-umkm" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama UMKM</th>
              <th>Deskripsi</th>
              <th>Alamat</th>
              <th>Nomor KTP Pemilik</th>
              <th>Tanggal Pendaftaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama UMKM</th>
              <th>Deskripsi</th>
              <th>Alamat</th>
              <th>Nomor KTP Pemilik</th>
              <th>Tanggal Pendaftaran</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4" id="js-karyawan-card" style="display: none;">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Karyawan <span class="js-nama-umkm"></span></h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item collapse-button" href="javascript:void(0)" onclick="toggleKaryawanCard(event)">Sembunyikan</a>
          <a class="dropdown-item close-button" href="javascript:void(0)" onclick="closeKaryawanCard(event)">Tutup</a>
        </div>
      </div>
    </div>
    <div class="card-body collapse show" id="js-karyawan-card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-karyawan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Tanggal Bergabung</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Tanggal Bergabung</th>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_script'); ?>
<!-- Page level plugins -->
<script src="<?php echo e(asset('vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<script>
  let tableUmkm = null;
  let tableKaryawan = null;
  let user = null;
  let _idCabang = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableUmkm = $("#js-tabel-umkm").DataTable();
    tableKaryawan = $("#js-tabel-karyawan").DataTable();


    $("#js-karyawan-card-body").on('hide.bs.collapse', function() {
      $('.collapse-button').text('Tampilkan');
    });

    $("#js-karyawan-card-body").on('show.bs.collapse', function() {
      $('.collapse-button').text('Sembunyikan');
    });

    getApprovedUmkm();
  });

  const toggleKaryawanCard = (e) => {
    $("#js-karyawan-card-body").collapse('toggle');
  }
  const closeKaryawanCard = (e) => {
    $("#js-karyawan-card").hide();
  }

  const showKaryawan = (umkmId) => {
    umkmStore.detailUmkm(umkmId).then((res) => {
      let data = res.data;
      $('.js-nama-umkm').text(data.nama_umkm);
    });

    employeeStore.getEmployee(umkmId)
      .then((res) => {
        let data = res.data;

        populateKaryawanTable(data);

        $('#js-karyawan-card').show();

        $([document.documentElement, document.body]).animate({
          scrollTop: $("#js-karyawan-card").offset().top
        }, 1000);
      });
  }

  const populateUmkmTable = (data) => {
    tableUmkm.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableUmkm.row.add([
        number,
        item.nama_umkm,
        item.deskripsi,
        item.alamat_umkm,
        item.no_ktp,
        item.tanggal_pendaftaran,
        `<button type="button" class="btn btn-sm btn-primary"
        onclick="showKaryawan(${item.umkm_id})">
        List Karyawan</button>`
      ]).draw();
      number++;
    });
  }

  const populateKaryawanTable = (data) => {
    tableKaryawan.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableKaryawan.row.add([
        number,
        item.nama,
        item.alamat,
        item.tanggal_bergabung
      ]).draw();
      number++;
    });
  }

  const getApprovedUmkm = () => {
    umkmStore.approvedUmkm().then((res) => {
      let dataUmkm = res.data;
      populateUmkmTable(dataUmkm);
    });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/umkm/karyawan.blade.php ENDPATH**/ ?>