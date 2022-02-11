<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Document</title>
  <style>
    .page-break {
      page-break-after: always;
    }
  </style>
</head>

<body>
  <h2>Laporan Penjualan <?php echo e($nama_umkm); ?></h2>
  <?php if(isset($nama_cabang)): ?>
    <h3>Cabang <?php echo e($nama_cabang); ?></h3>
  <?php endif; ?>

  <hr>
  <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <h3>Laporan Penjualan Bulan <?php echo e($report['month']); ?></h3>
    <table class="table table-bordered" style="width:100%">
      <tr>
        <th style="width: 10%;">Nomor</th>
        <th style="width: 45%;">Produk</th>
        <th style="width: 15%;">Harga</th>
        <th style="width: 15%;">Jumlah Terjual</th>
        <th style="width: 15%;">Total Keuntungan</th>
      </tr>
      <?php $__currentLoopData = $report['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e(($index + 1)); ?></td>
          <td><?php echo e($data['nama_produk']); ?></td>
          <td><?php echo Helper::toRupiah($data['harga']); ?></td>
          <td><?php echo e($data['jumlah']); ?></td>
          <td><?php echo Helper::toRupiah($data['total_harga']); ?></td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <th colspan="3">Sub Total</th>
        <th><?php echo e($report['profit']->jumlah_terjual); ?></th>
        <th><?php echo Helper::toRupiah($report['profit']->total_keuntungan); ?></th>
      </tr>
    <table>
    <div class="page-break"></div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

</body>

</html><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/report/pdf.blade.php ENDPATH**/ ?>