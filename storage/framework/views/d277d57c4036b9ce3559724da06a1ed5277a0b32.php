<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data UMKM</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-umkm-disetujui" width="100%" cellspacing="0">
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
</div>

<!-- Modal Detail -->
<div class="modal fade" id="js-detail-umkm-modal" tabindex="-1" role="dialog" aria-labelledby="umkmModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="umkmModal">Detail UMKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Page Content -->
        <div class="container">

          <!-- Portfolio Item Heading -->
          <h1 class="my-4">
            <span class="js-nama-umkm">Nama UMKM</span>
          </h1>

          <!-- Portfolio Item Row -->
          <div class="row">

            <div class="col-md-8">
              <img class="img-fluid js-gambar-umkm" src="" alt="">
            </div>

            <div class="col-md-4">
              <h4 class="my-3">Alamat:</h4>
              <p>
                <span class="js-alamat-umkm"></span>
              </p>
              <h4 class="my-3">Deskripsi:</h4>
              <p>
                <span class="js-deskripsi-umkm"></span>
              </p>
              <h4 class="my-3">Tanggal Bergabung:</h4>
              <p>
                <span class="js-tanggal-bergabung"></span>
              </p>
            </div>

          </div>

        </div>
        <!-- /.container -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  let tableApprovedUmkm = null;
  let user = null;
  let _idCabang = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableApprovedUmkm = $("#js-tabel-umkm-disetujui").DataTable();

    getApprovedUmkm();
  });

  const showUmkmModal = (umkmId) => {
    umkmStore.detailUmkm(umkmId).then((res) => {
      data = res.data

      $('.js-nama-umkm').text(data.nama_umkm);
      $('.js-alamat-umkm').text(data.alamat_umkm);
      $('.js-deskripsi-umkm').text(data.deskripsi);
      $('.js-tanggal-bergabung').text(data.tanggal_bergabung);
      $('.js-gambar-umkm').attr("src", data.gambar);

      $('#js-detail-umkm-modal').modal('show');
    });
  }

  const populateApprovedTable = (data) => {
    tableApprovedUmkm.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableApprovedUmkm.row.add([
        number,
        item.nama_umkm,
        item.deskripsi,
        item.alamat_umkm,
        item.no_ktp,
        item.tanggal_pendaftaran,
        `<button type="button" class="btn btn-sm btn-primary"
        onclick="showUmkmModal(${item.umkm_id})">
        Detail</button>`
      ]).draw();
      number++;
    });
  }

  const getApprovedUmkm = () => {
    umkmStore.approvedUmkm().then((res) => {
      approvedUmkm = res.data;
      populateApprovedTable(approvedUmkm);
      // populateCards(approvedUmkm);
    });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/umkm/data_umkm.blade.php ENDPATH**/ ?>