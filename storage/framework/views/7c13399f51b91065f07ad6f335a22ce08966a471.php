<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kasir</h1>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Kasir</h6>
    </div>
    <div class="card-body">
		<div id="js-resume-header" style="display:none;">
			<p>
				<mark>
				  *Total transaksi mulai tanggal <span id="js-tanggal-mulai"></span> - sekarang
				   adalah :
				</mark>
			  </p>
			<h2>Rp <span id="js-total-header"></span></h2>
		</div>

      <br>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-pending" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal Transaksi</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
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
  $auth.needRole(['kasir']);

  $moment.locale('id');
  let tableDailyTransaction = null;
  let user = $auth.userCredentials();
  let _idKasir = user.kasir.kasir_id;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableDailyTransaction = $("#js-tabel-pending").DataTable();

    getDailyTransactions();
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

  const deleteTransaction = (id) => {
    $swal({
        title: "Anda yakin?",
        text: `Transaksi ini akan dihapus selamanya!`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          pendingTransaction.remove(id);
          getDailyTransactions();
        }
      });
  }

  const populateTable = (data) => {
    tableDailyTransaction.clear().draw();

    data.forEach((item, i) => {
      tableDailyTransaction.row.add([
        i+1,
        $moment(item.tanggal_transaksi).format('D MMM YYYY - HH:mm:ss'),
        'Rp ' + $helper.rupiahFormat(item.total_harga),
        `<button type="button" class="btn btn-sm btn-primary"
          onclick="showCashierModal(${item.transaksi_kasir_id})">
          <i class="fas fa-eye"></i> Detail Transaksi</button>`
      ]).draw();
    });

    tableDailyTransaction.columns.adjust().draw();
  }

  // dummy function for get dummy products data
  // will be deleted on next development

  const getDailyTransactions = () => {
    axios.get('kasir/daily-reports/?kasir_id=' + _idKasir).then((res)=>{
      console.log(res);
      populateTable(res.data);
      if (res.data.length) {
        $('#js-resume-header').show();
        $('#js-tanggal-mulai').text(res.data[0].tanggal_transaksi);

        let total = 0;
        for (var item of res.data) {
          total += parseInt(item.total_harga);
        }

        $('#js-total-header').text($helper.rupiahFormat(total));
      }
    }).catch((err)=>{
      console.log(err);
      $ui.errorModal(err);
    });
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/kasir/daily_transaction.blade.php ENDPATH**/ ?>