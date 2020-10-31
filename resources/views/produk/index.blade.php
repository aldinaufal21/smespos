@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Produk</h1>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#js-tambah-produk-modal">
          <i class="fas fa-download fa-sm text-white-50"></i> Tambah Produk
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-produk" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Tanggal Input</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Kategori</th>
              <th>Harga</th>
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
<div class="modal fade" id="js-produk-modal" tabindex="-1" role="dialog" aria-labelledby="produkModal" aria-hidden="true">
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
              <img class="img-fluid js-gambar-produk" src="http://placehold.it/750x500" alt="">
            </div>

            <div class="col-md-4">
              <h3 class="my-3">Deskripsi Produk</h3>
              <p>
                <span class="js-deskripsi-produk"></span>
              </p>
              <h3 class="my-3">Kategori Produk</h3>
              <span class="js-kategori-produk"></span>
            </div>

          </div>

        </div>
        <!-- /.container -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Edit</button>
        <button type="button" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="js-tambah-produk-modal" tabindex="-1" role="dialog" aria-labelledby="tambahProdukModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahProdukModal">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="">
          <input type="hidden" name="_token" value="">
          <div class="form-group">
            <label class="control-label">Nama</label>
            <div>
              <input type="text" class="form-control input-lg" name="nama_produk" placeholder="Nama Produk">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Deskripsi</label>
            <div>
              <textarea class="form-control input-lg" name="deskripsi_produk" id="" cols="30" rows="10" placeholder="Deskripsi Produk"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Harga</label>
            <div>
              <input type="number" class="form-control input-lg" name="harga" placeholder="Rp. ">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Jumlah Produk</label>
            <div>
              <input type="number" class="form-control input-lg" name="jumlah" placeholder="Jumlah Produk">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Gambar</label>
            <div>
              <input type="file" class="form-control input-lg" name="gambar_produk" accept="image/*">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary float-right">
              Tambah
            </button>
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
  let tabelProduk = null;
  let user = null;
  let namaProduk = $('.js-nama-produk');
  let hargaProduk = $('.js-harga-produk');
  let deskripsiProduk = $('.js-deskripsi-produk');
  let kategoriProduk = $('.js-kategori-produk');
  let gambarProduk = $('.js-gambar-produk');

  $(document).ready(() => {
    user = userCredentials(); // get user credentials
    tablelProduk = $("#js-tabel-produk").DataTable();

    getProducts();
  });

  // dummy function for get dummy products data
  // will be deleted on next development

  const getProducts = () => {
    let umkm = user.umkm.umkm_id;

    productStore.UmkmsProduct(umkm).then((res) => {
      productData = res.data;
      populateTable(productData);
    });
  }

  const populateTable = (data) => {
    tablelProduk.clear().draw();
    let number = 1;

    data.forEach(item => {
      tablelProduk.row.add([
        number,
        item.nama_produk,
        item.deskripsi_produk,
        item.nama_kategori,
        item.harga,
        item.tanggal_input,
        `<button type="button" class="btn btn-sm btn-primary" id="js-show-produk"
          onclick="showProdukModal(${item.produk_id})"><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-sm btn-success" id="js-edit-produk" data-id="">
          <i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-sm btn-danger" id="js-delete-produk" data-id="">
          <i class="fas fa-trash"></i></button>`
      ]).draw();
      number++;
    });
  }

  const showProdukModal = (produkId) => {
    productStore.detailProduk(produkId).then((res) => {
      data = res.data

      namaProduk.text(data.nama_produk);
      hargaProduk.text(data.harga);
      deskripsiProduk.text(data.deskripsi_produk);
      kategoriProduk.text(data.nama_kategori);
      gambarProduk.attr("src", data.gambar);

      $('#js-produk-modal').modal('show');
    });
  }
</script>
@endsection