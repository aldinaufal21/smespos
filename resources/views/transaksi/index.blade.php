@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi Konsumen</h1>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Transaksi Konsumen</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-trankaksi" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Konsumen</th>
              <th>Jenis Order</th>
              <th>Status</th>
              <th>Catatan Order</th>
              <th>Bukti Transfer</th>
              <th>Tanggal Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Konsumen</th>
              <th>Jenis Order</th>
              <th>Status</th>
              <th>Catatan Order</th>
              <th>Bukti Transfer</th>
              <th>Tanggal Transaksi</th>
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
<div class="modal fade" id="js-trankaksi-modal-detail" tabindex="-1" role="dialog" aria-labelledby="trankaksiModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trankaksiModal">Transaksi Konsumen Detail</h5>
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
                <span class="js-nama-trankaksi"></span>
              </p>
              <h4 class="my-3">Status:</h4>
              <p>
                <span class="js-status-trankaksi"></span>
              </p>
              <h4 class="my-3">Username:</h4>
              <p>
                <span class="js-username-trankaksi"></span>
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
<div class="modal fade" id="js-trankaksi-modal-form" tabindex="-1" role="dialog" aria-labelledby="trankaksiModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="trankaksiModalForm">Tambah Transaksi Konsumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-trankaksi-form" data-edit="" onsubmit="branchFormAction(event)">
          <input type="hidden" name="_token" value="">
          <h4>Data Akun Transaksi Konsumen</h4>
          <div class="form-group">
            <label class="control-label">Username</label>
            <div>
              <input type="text" class="form-control input-lg" name="username" id="js-username-trankaksi" placeholder="Username">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password" id="js-password-trankaksi" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password_confirmation" id="js-password-confirm-trankaksi" placeholder="Konfirmasi Password">
            </div>
          </div>
          <hr>
          <h4>Data Transaksi Konsumen</h4>
          <div class="form-group">
            <label class="control-label">Nama Transaksi Konsumen</label>
            <div>
              <input type="text" class="form-control input-lg" name="nama_trankaksi" id="js-nama-trankaksi" placeholder="Nama TransaksiKonsumen">
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
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
  let tableTransaksiKonsumen = null;
  let user = null;
  let _idTransaksiKonsumen = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableTransaksiKonsumen = $("#js-tabel-trankaksi").DataTable();
  });

  const populateTable = (data) => {
    tableTransaksiKonsumen.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableTransaksiKonsumen.row.add([
        number,
        item.nama_trankaksi,
        item.status_trankaksi,
        `<button type="button" class="btn btn-sm btn-primary"
          onclick="showCashierModal(${item.trankaksi_id})">
          <i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-sm btn-success"
          onclick="openEditForm(${item.trankaksi_id})">
          <i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-sm btn-danger"
          onclick="deleteCashier(${item.trankaksi_id})">
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
@endsection