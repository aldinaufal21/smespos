@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
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
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-pending" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Tanggal Transaksi</th>
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
              <h4 class="my-3">Id Pending:</h4>
              <p id="id-pending"></p>
              <h4 class="my-3">Item Keranjang:</h4>
              <ul id="cart-detail-list"></ul>
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
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
  $auth.needRole(['kasir']);

  $moment.locale('id');
  let tablePendingTransaction = null;
  let user = null;
  let _idKasir = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tablePendingTransaction = $("#js-tabel-pending").DataTable();

    getPendingTransactions();
  });

  const showCashierModal = (id) => {
    let data = pendingTransaction.getItem(id);
    // console.log(data);
    $('#id-pending').text(data.pending_id);
    $('#cart-detail-list').empty();

    for (var item of data.cart_items) {
        $('#cart-detail-list').append(`
          <li>${item.nama_produk} (${item.quantity} item) @Rp ${$helper.rupiahFormat(item.harga)}</li>
          `)
    }

    $('#js-kasir-modal-detail').modal('show');
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
          getPendingTransactions();
        }
      });
  }

  const populateTable = (data) => {
    tablePendingTransaction.clear().draw();

    data.forEach((item, i) => {
      tablePendingTransaction.row.add([
        i+1,
        item.kasir.nama_kasir,
        $moment(item.tanggal_transaksi).format('D MMM YYYY - HH:mm:ss'),
        `<a href="transaksi?continue=${item.pending_id}" class="btn btn-sm btn-success">
          <i class="fas fa-edit"></i> Lanjutkan Transaksi</a>
        <button type="button" class="btn btn-sm btn-primary"
          onclick="showCashierModal(${item.pending_id})">
          <i class="fas fa-eye"></i> Detail Transaksi</button>
        <button type="button" class="btn btn-sm btn-danger"
          onclick="deleteTransaction(${item.pending_id})">
          <i class="fas fa-trash"></i></button>`
      ]).draw();
    });

    tablePendingTransaction.columns.adjust().draw();
  }

  // dummy function for get dummy products data
  // will be deleted on next development

  const getPendingTransactions = () => {
    let data = pendingTransaction.getAll();
    console.log(data);
    populateTable(data);
  }
</script>
@endsection
