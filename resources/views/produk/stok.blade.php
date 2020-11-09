@extends('layouts.app')

@section('title','Stok Produk')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Stok Produk</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List Produk</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right"></div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="js-tabel-produk" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4" id="js-stok-card" style="display: none;">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Stok Produk <b>"<span id="js-nama-produk-stok"></span>"</b></h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item collapse-button" href="javascript:void(0)" onclick="toggleStokCard(event)">Sembunyikan</a>
          <a class="dropdown-item close-button" href="javascript:void(0)" onclick="closeStokCard(event)">Tutup</a>
        </div>
      </div>
    </div>
    <div class="card-body collapse show" id="js-stok-card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right"></div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="js-tabel-stok" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Stok</th>
              <th>Tanggal Input</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Stok</th>
              <th>Tanggal Input</th>
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
<div class="modal fade" id="js-produk-modal-detail" tabindex="-1" role="dialog" aria-labelledby="produkModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="produkModal">Produk Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Page Content -->
        <div class="container">

          <!-- Portfolio Item Heading -->
          <h1 class="my-4">
            <span class="js-nama-produk">Nama Produk</span>
            <small>Rp. <span class="js-harga-produk"></span></small>
          </h1>

          <!-- Portfolio Item Row -->
          <div class="row">

            <div class="col-md-8">
              <img class="img-fluid js-gambar-produk" src="" alt="">
            </div>

            <div class="col-md-4">
              <h3 class="my-3">Deskripsi Produk</h3>
              <p>
                <span class="js-deskripsi-produk"></span>
              </p>
              <h3 class="my-3">Kategori Produk</h3>
              <span class="js-kategori-produk"></span>

              <h3 class="my-3">Stok</h3>
              <span class="js-stok-produk"></span>
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

<!-- Modal Stok -->
<div class="modal fade" id="js-produk-stok-modal-form" tabindex="-1" role="dialog" aria-labelledby="produkStokModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="produkStokModalForm">Tambah Stok Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Tambah Stok <b>"<span id="js-nama-produk"></span>"</b></h4>
        <form role="form" id="js-stok-produk-form" data-edit="" onsubmit="submitStockChanges(event)">
          <input type="hidden" name="produk_id" id="js-hidden-produk-id" value="">
          <div class="form-group">
            <label class="control-label">Jumlah Stok</label>
            <div>
              <input type="number" class="form-control input-lg" name="stok" id="js-jumlah-stok" placeholder="Jumlah Stok">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary float-right" id="js-submit-button"></button>
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
  $auth.needRole(['cabang','umkm']);
  let tabelProduk = null;
  let tabelStok = null;
  let _idStok = null;
  let user = null;
  let namaProduk = $('.js-nama-produk');
  let hargaProduk = $('.js-harga-produk');
  let deskripsiProduk = $('.js-deskripsi-produk');
  let kategoriProduk = $('.js-kategori-produk');
  let stokProduk = $('.js-stok-produk');
  let gambarProduk = $('.js-gambar-produk');

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableProduk = $("#js-tabel-produk").DataTable({
      pageLength: 5,
    });

    tabelStok = $("#js-tabel-stok").DataTable({
      pageLength: 5,
    });

    $("#js-stok-card-body").on('hide.bs.collapse', function() {
      $('.collapse-button').text('Tampilkan');
    });

    $("#js-stok-card-body").on('show.bs.collapse', function() {
      $('.collapse-button').text('Sembunyikan');
    });

    getProducts();
  });

  const toggleStokCard = (e) => {
    $("#js-stok-card-body").collapse('toggle');
  }
  const closeStokCard = (e) => {
    $("#js-stok-card").hide();
  }

  const openEditForm = (idStok) => {
    _idStok = idStok;
    stockStore.stockDetail(idStok).then((res) => {
      let data = res.data;

      $('#js-jumlah-stok').val(data.stok);;
    });

    $('#js-stok-produk-form').attr('data-edit', 'true');
    $('#js-submit-button').text('Ubah');
    $('#js-produk-stok-modal-form').modal('show');
  }

  const openAddForm = (idProduk, namaProduk) => {
    $('#js-hidden-produk-id').val(idProduk);
    $('#js-nama-produk').text(namaProduk);

    $('#js-stok-produk-form').attr('data-edit', '');
    $('#js-submit-button').text('Tambah');
    $('#js-produk-stok-modal-form').modal('show');
  }

  const submitStockChanges = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-stok-produk-form'));

    let payload = {
      data: formData
    }

    let formEdit = $('#js-stok-produk-form').attr('data-edit');

    if (formEdit) {
      payload.id = _idStok;
      delete payload.data.produk_id;

      stockStore.updateStock(payload)
        .then(res => {
          let data = res.data;
          if (res.status == 200) {
            showProdukStock(data.produk_id);
          }
        })
    } else {
      stockStore.addStock(payload)
        .then(res => {
          let data = res.data;
          if (res.status == 201) {
            showProdukStock(data.produk_id);
          }
        })
    }
  }

  const showProdukModal = (produkId) => {
    productStore.productDetail(produkId).then((res) => {
      data = res.data

      namaProduk.text(data.nama_produk);
      hargaProduk.text($helper.rupiahFormat(data.harga));
      deskripsiProduk.text(data.deskripsi_produk);
      kategoriProduk.text(data.nama_kategori);
      stokProduk.text(data.stok);
      gambarProduk.attr("src", data.gambar_produk);

      $('#js-produk-modal-detail').modal('show');
    });
  }

  const showProdukStock = (produkId) => {
    productStore.productDetail(produkId).then((res) => {
      let data = res.data
      $('#js-nama-produk-stok').text(data.nama_produk);
    });

    stockStore.allStock(produkId).then((res) => {
      let data = res.data;

      populateStockTable(data);

      $('#js-stok-card').show();

      $([document.documentElement, document.body]).animate({
        scrollTop: $("#js-stok-card").offset().top
      }, 1000);
    });
  }

  const tableProdukActionButtons = (item) => {
    if (user.user.role == 'umkm') {
      return `<button type="button" class="btn btn-sm btn-primary"
          onclick="showProdukModal(${item.produk_id})">
          <i class="fas fa-eye"></i> Detail Produk</button>`;
    } else {
      return `<button type="button" class="btn btn-sm btn-primary"
          onclick="showProdukModal(${item.produk_id})">
          <i class="fas fa-eye"></i> Detail Produk</button>
        <button type="button" class="btn btn-sm btn-info"
          onclick="showProdukStock(${item.produk_id})">
          <i class="fas fa-eye"></i> Lihat Stok</button>
        <button type="button" class="btn btn-sm btn-success"
          onclick="openAddForm(${item.produk_id}, '${item.nama_produk}')">
          <i class="fas fa-plus"></i> Tambah Stok</button>`;
    }
  }

  const populateProductTable = (data) => {
    tableProduk.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableProduk.row.add([
        number,
        item.nama_produk,
        item.nama_kategori,
        $helper.rupiahFormat(item.harga),
        tableProdukActionButtons(item)
      ]).draw();
      number++;
    });

    tableProduk.columns.adjust().draw();
  }

  const populateStockTable = (data) => {
    tabelStok.clear().draw();
    let number = 1;

    data.forEach(item => {
      tabelStok.row.add([
        number,
        item.stok,
        item.tanggal_input,
        `<button
          type="button"
          class="btn btn-sm btn-success"
          onclick="openEditForm(${item.stok_id})"
          style='display: ${buttonAvailability(item.tanggal_input)}'>
          Ubah Stok</button>`
      ]).draw();
      number++;
    });

    tabelStok.columns.adjust().draw();

    function buttonAvailability(dateTime) {
      let inputDate = new Date(dateTime).getDate();
      let todayDate = new Date(Date.now()).getDate();

      return inputDate == todayDate ? 'block' : 'none';
    }
  }

  const getOwnerId = () => {
    if (user.user.role == 'umkm') {
      return user.umkm.umkm_id
    } else if (user.user.role == 'cabang') {
      return user.cabang.umkm_id
    }
  }

  const getProducts = () => {
    let ownerId = getOwnerId();

    productStore.UmkmsProduct(ownerId).then((res) => {
      productData = res.data;
      populateProductTable(productData);
    });
  }
</script>
@endsection
