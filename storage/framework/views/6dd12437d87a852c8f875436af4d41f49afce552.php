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
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
        <button class="btn btn-primary" onclick="openCreateForm()">
          <i class="fas fa-plus-circle fa-sm text-white-50"></i> Tambah Kasir
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-kasir" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Status</th>
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
<div class="modal fade" id="js-kasir-modal-detail" tabindex="-1" role="dialog" aria-labelledby="kasirModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kasirModal">Kasir Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Page Content -->
        <div class="container">
          <div class="row">
            <div class="col">
              <h4 class="my-3">Nama:</h4>
              <p>
                <span class="js-nama-kasir"></span>
              </p>
              <h4 class="my-3">Status:</h4>
              <p>
                <span class="js-status-kasir"></span>
              </p>
              <h4 class="my-3">Username:</h4>
              <p>
                <span class="js-username-kasir"></span>
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

<!-- Modal Tambah -->
<div class="modal fade" id="js-kasir-modal-form" tabindex="-1" role="dialog" aria-labelledby="kasirModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="kasirModalForm">Tambah Kasir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-kasir-form" data-edit="" onsubmit="branchFormAction(event)">
          <input type="hidden" name="_token" value="">
          <h4>Data Akun Kasir</h4>
          <div class="form-group">
            <label class="control-label">Username</label>
            <div>
              <input type="text" class="form-control input-lg" name="username" id="js-username-kasir" placeholder="Username">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password" id="js-password-kasir" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password_confirmation" id="js-password-confirm-kasir" placeholder="Konfirmasi Password">
            </div>
          </div>
          <hr>
          <h4>Data Kasir</h4>
          <div class="form-group">
            <label class="control-label">Nama Kasir</label>
            <div>
              <input type="text" class="form-control input-lg" name="nama_kasir" id="js-nama-kasir" placeholder="Nama Kasir">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" id="js-submit-button" class="btn btn-primary float-right"></button>
            <button type="reset" class="btn btn-warning float-right mr-2">
              Batal
            </button>
          </div>
        </form>
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
  let tableKasir = null;
  let user = null;
  let _idKasir = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableKasir = $("#js-tabel-kasir").DataTable();

    getCashier();
  });

  const openCreateForm = () => {
    $helper.resetForm($('#js-kasir-form'));
    $('#js-kasir-form').attr('data-edit', '');
    $('#js-submit-button').text('Tambah');
    $('#js-kasir-modal-form').modal('show');
  }

  const openEditForm = (idKasir) => {
    _idKasir = idKasir;
    cashierStore.detailCashier(idKasir)
      .then(res => {
        data = res.data;

        $('#js-username-kasir').val("");
        $('#js-nama-kasir').val(data.nama_kasir);
        $('#js-username-kasir').val(data.username);

        $('#js-kasir-form').attr('data-edit', 'true');
        $('#js-submit-button').text('Ubah');
        $('#js-kasir-modal-form').modal('show');
      });
  }

  const branchFormAction = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-kasir-form'));

    let payload = {
      data: formData,
    }

    let formEdit = $('#js-kasir-form').attr('data-edit');
    $ui.toggleButtonLoading($('#js-kasir-form'));

    if (formEdit) {
      payload.id = _idKasir;
      cashierStore.updateCashier(payload)
        .then(res => {
          if (res.status == 200) {
            getCashier();
            $helper.resetForm($('#js-kasir-form'));
            $ui.toggleButtonLoading($('#js-kasir-form'), false);
          }
        })
    } else {
      cashierStore.addCashier(payload)
        .then(res => {
          if (res.status == 201) {
            getCashier();
            $helper.resetForm($('#js-kasir-form'));
            $ui.toggleButtonLoading($('#js-kasir-form'), false);
          }
        })
    }
  }

  const showCashierModal = (cashierId) => {
    cashierStore.detailCashier(cashierId).then((res) => {
      data = res.data

      $('.js-nama-kasir').text(data.nama_kasir);
      $('.js-status-kasir').text(data.status_kasir);
      $('.js-username-kasir').text(data.username);

      $('#js-kasir-modal-detail').modal('show');
    });
  }

  const deleteCashier = (idKasir) => {
    cashierStore.detailCashier(idKasir)
      .then(res => {
        data = res.data;

        $swal({
            title: "Anda yakin?",
            text: `Kasir ${data.nama_kasir} akan dihapus selamanya!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $swal("Mohon tunggu...");
              cashierStore.destroyCashier(idKasir)
                .then(res => {
                  $swal("Kasir Berhasil Dihapus!", {
                    icon: "success",
                  });
                  getCashier();
                })
                .catch(err => {
                  console.log(err);
                  $swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi Kesalahan!',
                  })
                });
            } else {
              $swal("Kasir Batal Dihapus!");
            }
          });
      });
  }

  const populateTable = (data) => {
    tableKasir.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableKasir.row.add([
        number,
        item.nama_kasir,
        item.status_kasir,
        `<button type="button" class="btn btn-sm btn-primary"
          onclick="showCashierModal(${item.kasir_id})">
          <i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-sm btn-success"
          onclick="openEditForm(${item.kasir_id})">
          <i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-sm btn-danger"
          onclick="deleteCashier(${item.kasir_id})">
          <i class="fas fa-trash"></i></button>`
      ]).draw();
      number++;
    });
  }

  // dummy function for get dummy products data
  // will be deleted on next development

  const getCashier = () => {
    cashierStore.allCashier().then((res) => {
      cashierData = res.data;
      populateTable(cashierData);
    });
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/kasir/index.blade.php ENDPATH**/ ?>