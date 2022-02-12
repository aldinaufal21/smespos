<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<style>
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Penjualan Kasir</h1>
    <form action="<?php echo e(route('report.download')); ?>" method="post">
      <?php echo csrf_field(); ?>
      <input type="hidden" id="js-role" name="role" value="">
      <input type="hidden" id="js-id_cabang" name="cabang_id" value="">
      <input type="hidden" id="js-id_umkm" name="umkm_id" value="">
      <input type="hidden" id="js-dari_bulan" name="dari_bulan" value="">
      <input type="hidden" id="js-sampai_bulan" name="sampai_bulan" value="">

      
    </form>
  </div>
  <div class="row">
    <div class="col-3">
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pilih Cabang</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <select class="form-control" id="select-cabang" onchange="selectCabang();">
                            <?php $__currentLoopData = $cabang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($cabang_detail->cabang_id == $item->cabang_id): ?> selected <?php endif; ?> value="<?php echo e($item->cabang_id); ?>"><?php echo e($item->nama_cabang); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Periode Laporan (bulan)</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form role="form" id="js-filter-form" action="<?php echo e(route('kasir_umkm.kasir_result')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="input-group mb-3">
                            <input type="text" name="periode" value="<?php echo e($periode); ?>" class="form-control js-month-datepicker" placeholder="Pilih Periode Per Bulan" aria-label="Periode" aria-describedby="calendar-addon" readonly>
                            <input type="hidden" name="id_umkm" id="form-umkm-id" class="form-control">
                            <input type="hidden" name="id_cabang" value="<?php echo e($cabang_detail->cabang_id); ?>" id="form-cabang-id" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
                            </div>
                            </div>
                            <div class="form-group">
                            <input type="submit" class="btn btn-primary float-right" value="Filter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Periode Laporan (rentang waktu)</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form role="form" id="js-filter-form" action="<?php echo e(route('kasir_umkm.kasir_result')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id_umkm" id="form-umkm-id-2" class="form-control">
                            <input type="hidden" name="id_cabang" value="<?php echo e($cabang_detail->cabang_id); ?>" id="form-cabang-id-2" class="form-control">
                            <div class="input-group mb-3">
                            <div class="row mb-3">
                                <div class="input-group">
                                <input type="text" name="mulai_periode" class="form-control js-date-datepicker" value="<?php echo e($mulai_periode); ?>" placeholder="Mulai" aria-label="Periode" aria-describedby="calendar-addon" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group">
                                <input type="text" name="selesai_periode" class="form-control js-date-datepicker" value="<?php echo e($selesai_periode); ?>" placeholder="Selesai" aria-label="Periode" aria-describedby="calendar-addon" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <input type="submit" class="btn btn-primary float-right" value="Filter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-9">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Terjual Kasir Cabang <?php echo e($cabang_detail->nama_cabang); ?></h6>
        </div>
        <div class="card-body">
          <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
          </div>
          <div id="js-resume-header">
            <p>
              <?php if($periode): ?>
                <mark>
                  *Transaksi periode <span id="js-tanggal-mulai"><?php echo e($periode); ?></span>
                </mark>
              <?php else: ?>
                <mark>
                  *Transaksi mulai tanggal <span id="js-tanggal-mulai"><?php echo e($mulai_periode); ?></span> - <span id="js-tanggal-mulai"><?php echo e($selesai_periode); ?></span>
                </mark>
              <?php endif; ?>
            </p>
          </div>
          <div class="table-responsive">
            <table class="table" id="js-report-table" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item+1); ?></td>
                            <td><?php echo e($value->tanggal_transaksi); ?></td>
                            <td>Rp. <?php echo e(number_format($value->total_harga,0,',','.')); ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary"
                                onclick="showCashierModal(<?php echo e($value->transaksi_kasir_id); ?>)">
                                <i class="fas fa-eye"></i> Detail Transaksi</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card shadow mb-4" id="js-total-pendapatan-card">
        <div class="card-body">
          <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
            <span id="js-pendapatan-bulan">Rp. <?php echo e(number_format($total,0,',','.')); ?></span>
          </div>
          Total Pendapatan <span id="js-teks-pendapatan-bulan"></span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="js-kasir-modal-detail" tabindex="-1" role="dialog" aria-labelledby="kasirModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="kasirModal">Detail pembelian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <!-- Page Content -->
            <div class="container">
                <div class="row">
                <div class="col">
                    <ul class="list-group" id="js-produk-list-detail">
    
                    </ul>
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
  $auth.needRole(['umkm']);

  $moment.locale('id');
  let tableDailyTransaction = null;
  let user = $auth.userCredentials();
  let _idUmkm = user.umkm.umkm_id;
  let _idCabang = null;

  function selectCabang(){
    let _idCabang = $("#select-cabang").val();

    const formIdCabang = document.getElementById('form-cabang-id').value = _idCabang;
    const formIdCabang2 = document.getElementById('form-cabang-id-2').value = _idCabang;

    console.log(_idCabang);
  }

  const formIdUmkm = document.getElementById('form-umkm-id').value = _idUmkm;
  const formIdUmkm2 = document.getElementById('form-umkm-id-2').value = _idUmkm;

  console.log(formIdUmkm);
  $(document).ready(() => {
    let shouldStartDate = null;

    $(".js-month-datepicker").datepicker({
      format: "yyyy-mm",
      viewMode: "months",
      minViewMode: "months",
      startDate: $helper.yearMonthDateFormat(shouldStartDate),
      endDate: new Date(),
    });

    $(".js-date-datepicker").datepicker({
      format: "yyyy-mm-dd",
      viewMode: "days",
      minViewMode: "days",
      endDate: new Date(),
    });

    $('#js-report-table').DataTable();
  });

  const showCashierModal = (id) => {
    axios.get('kasir/daily-reports-detail/?transaksi_kasir_id=' + id).then((res)=>{
      $('#js-produk-list-detail').empty();

      for (let item of res.data) {
        $('#js-produk-list-detail').append(`
          <li class="list-group-item">
            <img style="float:left" src="${item.gambar_produk}" alt="" height="150px">
            <p style="float:left">
              <b>${item.nama_produk}</b><br>
              ${item.jumlah} x @${$helper.rupiahFormat(item.harga)}<br>
              Rp ${$helper.rupiahFormat(item.harga * item.jumlah)}
            </p>
          </li>
        `);
      }

      $('#js-kasir-modal-detail').modal('show');
    }).catch((err)=>{
      console.log(err);
      $ui.errorModal(err);
    });

  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/izharauliataqwa/Documents/project/idukafix/resources/views/kasir_umkm/kasir_result.blade.php ENDPATH**/ ?>