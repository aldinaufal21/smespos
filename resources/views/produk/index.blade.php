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
        <button class="btn btn-primary" id="js-btn-tambah-produk" onclick="openCreateForm()">
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
              <th>Stok</th>
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

<!-- Modal Tambah -->
<div class="modal fade" id="js-produk-modal-form" tabindex="-1" role="dialog" aria-labelledby="produkModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="produkModalForm">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-produk-form" data-edit="" onsubmit="productFormAction(event)" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="">
          <div class="form-group">
            <label class="control-label">Nama</label>
            <div>
              <input type="text" class="form-control input-lg" name="nama_produk" id="js-nama-produk" placeholder="Nama Produk">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Kategori</label>
            <div>
              <select name="kategori_produk_id" id="js-kategori-produk" class="form-control input-lg">
                <option value="">Pilih Kategori</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Deskripsi</label>
            <div>
              <textarea class="form-control input-lg" name="deskripsi_produk" id="js-deskripsi-produk" cols="30" rows="10" placeholder="Deskripsi Produk"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Harga</label>
            <div>
              <input type="number" class="form-control input-lg" name="harga" id="js-harga-produk" placeholder="Rp. ">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Gambar</label>
            <div>
              <input type="file" class="form-control input-lg" name="gambar_produk" accept="image/*">
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

<!-- Modal Stok -->
<div class="modal fade" id="js-produk-stock-modal-form" tabindex="-1" role="dialog" aria-labelledby="produkStockModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="produkStockModalForm">Tambah Stok Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Tambah Stok <span id="js-stok-nama-produk"></span></h4>
        <form role="form" id="js-stok-produk-form" onsubmit="submitStockChanges(event)">
          <input type="hidden" name="_token" value="">
          <div class="form-group">
            <label class="control-label">Jumlah Produk</label>
            <div>
              <input type="number" class="form-control input-lg" name="stok" placeholder="Jumlah Produk">
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
  let _idProduk = null;
  let namaProduk = $('.js-nama-produk');
  let hargaProduk = $('.js-harga-produk');
  let deskripsiProduk = $('.js-deskripsi-produk');
  let kategoriProduk = $('.js-kategori-produk');
  let stokProduk = $('.js-stok-produk');
  let gambarProduk = $('.js-gambar-produk');

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableProduk = $("#js-tabel-produk").DataTable();
    buttonTambahProdukCondition();

    getProducts();
    getCategory();
  });

  const openCreateForm = () => {
    populateDropdown();

    $('#js-produk-form').attr('data-edit', '');
    $('#js-submit-button').text('Tambah');
    $('#js-produk-modal-form').modal('show');
  }

  const openEditForm = (idProduk) => {
    populateDropdown();

    _idProduk = idProduk;
    productStore.productDetail(idProduk)
      .then(res => {
        data = res.data;

        $('#js-nama-produk').val(data.nama_produk);
        $('#js-kategori-produk').val(data.kategori_produk_id);
        $('#js-deskripsi-produk').val(data.deskripsi_produk);
        $('#js-harga-produk').val(data.harga);

        $('#js-produk-form').attr('data-edit', 'true');
        $('#js-submit-button').text('Ubah');
        $('#js-produk-modal-form').modal('show');
      });
  }

  const productStockForm = (idProduk) => {
    _idProduk = idProduk;
    productStore.productDetail(idProduk)
      .then(res => {
        data = res.data;

        $('#js-stok-nama-produk').text(data.nama_produk);

        $('#js-produk-stock-modal-form').modal('show');
      });
  }

  const submitStockChanges = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-stok-produk-form'));

    let payload = {
      data: formData,
      id: _idProduk
    }

    stockStore.addStock(payload)
      .then(res => {
        if (res.status == 201) { }
      })
  }

  const productFormAction = (e) => {
    e.preventDefault();

    var formData = new FormData($('#js-produk-form')[0]);

    let payload = {
      data: formData,
    }

    let formEdit = $('#js-produk-form').attr('data-edit');

    if (formEdit) {
      payload.id = _idProduk;
      productStore.updateProduct(payload)
        .then(res => {
          if (res.status == 200) {
            getProducts();
          }
        })
    } else {
      productStore.addProduct(payload)
        .then(res => {
          if (res.status == 201) {
            getProducts();
          }
        })
    }
  }

  const showProdukModal = (produkId) => {
    productStore.productDetail(produkId).then((res) => {
      data = res.data

      namaProduk.text(data.nama_produk);
      hargaProduk.text(data.harga);
      deskripsiProduk.text(data.deskripsi_produk);
      kategoriProduk.text(data.nama_kategori);
      stokProduk.text(data.stok);
      gambarProduk.attr("src", data.gambar_produk);

      $('#js-produk-modal-detail').modal('show');
    });
  }

  const deleteProduct = (idProduk) => {
    productStore.productDetail(idProduk)
      .then(res => {
        data = res.data;

        $swal({
            title: "Anda yakin?",
            text: `Produk ${data.nama_produk} akan dihapus selamanya!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              productStore.destroyProduct(idProduk)
                .then(res => {
                  $swal("Produk Berhasil Dihapus!", {
                    icon: "success",
                  });
                  getProducts();
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
              $swal("Produk Batal Dihapus!");
            }
          });
      });
  }

  const tableActionButtons = (item) => {
    if (user.user.role == 'umkm') {
      return `<button type="button" class="btn btn-sm btn-primary"
          onclick="showProdukModal(${item.produk_id})">
          <i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-sm btn-success"
          onclick="openEditForm(${item.produk_id})">
          <i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-sm btn-danger"
          onclick="deleteProduct(${item.produk_id})">
          <i class="fas fa-trash"></i></button>`;
    } else {
      return `<button type="button" class="btn btn-sm btn-primary"
          onclick="showProdukModal(${item.produk_id})">
          <i class="fas fa-eye"></i></button>`;
    }
  }

  const buttonTambahProdukCondition = () => {
    if (user.user.role != 'umkm') {
      $('#js-btn-tambah-produk').hide();
    } else {
      $('#js-btn-tambah-produk').show();
    }
  }

  const populateTable = (data) => {
    tableProduk.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableProduk.row.add([
        number,
        item.nama_produk,
        item.deskripsi_produk,
        item.nama_kategori,
        item.harga,
        item.stok,
        item.tanggal_input,
        tableActionButtons(item)
      ]).draw();
      number++;
    });
  }

  const populateDropdown = () => {
    let $dropdown = $('#js-kategori-produk');
    $dropdown.empty();
    $dropdown.append($("<option />").val("").text("Pilih Kategori"));

    $.each(listKategoriProduk, function() {
      $dropdown.append($("<option />").val(this.kategori_produk_id).text(this.nama_kategori));
    });
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
      populateTable(productData);
    });
  }

  const getCategory = async () => {
    let ownerId = getOwnerId();

    let category = await categoryStore.UmkmsCategory(ownerId);

    listKategoriProduk = category.data;
  }
</script>
@endsection