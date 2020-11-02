@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
        <button class="btn btn-primary" onclick="createCategory()">
          <i class="fas fa-download fa-sm text-white-50"></i> Tambah Kategori
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-kategori" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama Kategori</th>
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

<!-- Modal Tambah -->
<div class="modal fade" id="js-kategori-modal" tabindex="-1" role="dialog" aria-labelledby="tambahProdukModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahProdukModal">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-kategori-form" data-edit="" onsubmit="categoryFormAction(event)">
          <input type="hidden" name="_token" value="">
          <div class="form-group">
            <label class="control-label">Nama Kategori</label>
            <div>
              <input type="text" class="form-control input-lg" id="js-nama-kategori" name="nama_kategori" placeholder="Nama Kategori">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary float-right" id="js-submit-button">
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
  let tabelKategori = null;
  let user = null;
  let _idKategori = null;

  $(document).ready(() => {
    user = userCredentials(); // get user credentials
    tabelKategori = $("#js-tabel-kategori").DataTable();

    getCategories();
  });

  // dummy function for get dummy products data
  // will be deleted on next development

  const getCategories = () => {
    let umkm = user.umkm.umkm_id;

    categoryStore.UmkmsCategory(umkm).then((res) => {
      categories = res.data;
      populateTable(categories);
    });
  }

  const populateTable = (data) => {
    tabelKategori.clear().draw();
    let number = 1;

    data.forEach(item => {
      tabelKategori.row.add([
        number,
        item.nama_kategori,
        `<button type="button" class="btn btn-sm btn-success" onclick="editCategory(${item.kategori_produk_id})" data-id="${item.kategori_produk_id}">
          <i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-sm btn-danger" onclick="deleteCategory(${item.kategori_produk_id})" data-id="">
          <i class="fas fa-trash"></i></button>`
      ]).draw();
      number++;
    });
  }

  const categoryFormAction = (e) => {
    e.preventDefault();

    let formData = serializeObject($('#js-kategori-form'));

    let payload = {
      data: formData,
    }

    let formEdit = $('#js-kategori-form').attr('data-edit');

    if (formEdit) {
      payload.id = _idKategori;
      categoryStore.updateCategory(payload)
        .then(res => {
          if (res.status == 200) {
            getCategories();
          }
        })
    } else {
      categoryStore.addCategory(payload)
        .then(res => {
          if (res.status == 201) {
            getCategories();
          }
        })
    }
  }

  const createCategory = () => {
    $('#js-kategori-form').attr('data-edit', '');
    $('#js-submit-button').text('Tambah');
    $('#js-kategori-modal').modal('show');
  }

  const editCategory = (idKategori) => {
    _idKategori = idKategori;
    categoryStore.categoryDetail(idKategori)
      .then(res => {
        data = res.data;

        $('#js-nama-kategori').val(data.nama_kategori);
        $('#js-kategori-form').attr('data-edit', 'true');
        $('#js-submit-button').text('Ubah');

        $('#js-kategori-modal').modal('show');
      });
  }

  const deleteCategory = (idKategori) => {
    categoryStore.categoryDetail(idKategori)
      .then(res => {
        data = res.data;

        $swal({
            title: "Anda yakin?",
            text: `Kategori ${data.nama_kategori} akan dihapus selamanya!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              categoryStore.destroyCategory(idKategori)
                .then(res => {
                  $swal("Kategori Berhasil Dihapus!", {
                    icon: "success",
                  });
                  getCategories();
                })
                .catch(err => {
                  $swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi Kesalahan!',
                  })
                });
            } else {
              $swal("Kategori Batal Dihapus!");
            }
          });
      });
  }
</script>
@endsection