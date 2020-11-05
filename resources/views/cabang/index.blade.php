@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cabang</h1>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Cabang</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
        <button class="btn btn-primary" onclick="openCreateForm()">
          <i class="fas fa-download fa-sm text-white-50"></i> Tambah Cabang
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-cabang" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jumlah Karyawan</th>
              <th>Kode Cabang</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jumlah Karyawan</th>
              <th>Kode Cabang</th>
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
<div class="modal fade" id="js-cabang-modal-detail" tabindex="-1" role="dialog" aria-labelledby="karyawanModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="karyawanModal">Cabang Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Page Content -->
        <div class="container">

          <!-- Portfolio Item Heading -->
          <h1 class="my-4">
            <span class="js-nama-cabang">Nama Cabang</span>
          </h1>

          <!-- Portfolio Item Row -->
          <div class="row">

            <div class="col-md-8">
              <img class="img-fluid js-gambar-karyawan" src="" alt="">
            </div>

            <div class="col-md-4">
              <h4 class="my-3">Alamat:</h4>
              <p>
                <span class="js-alamat-cabang"></span>
              </p>
              <h4 class="my-3">Jumlah Karyawan:</h4>
              <p>
                <span class="js-jumlah-karyawan"></span>
              </p>
              <h4 class="my-3">Username:</h4>
              <p>
                <span class="js-username-cabang"></span>
              </p>
              <h4 class="my-3">Kode Cabang:</h4>
              <p>
                <span class="js-kode-cabang"></span>
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
<div class="modal fade" id="js-cabang-modal-form" tabindex="-1" role="dialog" aria-labelledby="cabangModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cabangModalForm">Tambah Cabang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-cabang-form" data-edit="" onsubmit="branchFormAction(event)" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="">
          <h4>Data Akun Cabang</h4>
          <div class="form-group">
            <label class="control-label">Username</label>
            <div>
              <input type="text" class="form-control input-lg" name="username" id="js-username-cabang" placeholder="Username">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password" id="js-password-cabang" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password_confirmation" id="js-password-confirm-cabang" placeholder="Konfirmasi Password">
            </div>
          </div>
          <hr>
          <h4>Data Cabang</h4>
          <div class="form-group">
            <label class="control-label">Nama</label>
            <div>
              <input type="text" class="form-control input-lg" name="nama_cabang" id="js-nama-cabang" placeholder="Nama Cabang">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Alamat</label>
            <div>
              <textarea class="form-control input-lg" name="alamat_cabang" id="js-alamat-cabang" cols="30" rows="5" placeholder="Alamat Cabang"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Kode Cabang</label>
            <div>
              <input type="text" class="form-control input-lg" name="kode_cabang" id="js-kode-cabang" placeholder="Kode Cabang">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Jumlah Karyawan</label>
            <div>
              <input type="number" class="form-control input-lg" name="jumlah_karyawan" id="js-jumlah-karyawan" placeholder="Jumlah Karyawan">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Foto Karyawan</label>
            <div>
              <input type="file" class="form-control input-lg" name="gambar_karyawan" accept="image/*">
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
  let tableCabang = null;
  let user = null;
  let _idCabang = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableCabang = $("#js-tabel-cabang").DataTable();

    getBranch();
  });

  const openCreateForm = () => {
    $('#js-cabang-form').attr('data-edit', '');
    $('#js-submit-button').text('Tambah');
    $('#js-cabang-modal-form').modal('show');
  }

  const openEditForm = (idCabang) => {
    _idCabang = idCabang;
    branchStore.detailBranch(idCabang)
      .then(res => {
        data = res.data;

        $('#js-username-cabang').val(data.username);
        $('#js-nama-cabang').val(data.nama_cabang);
        $('#js-alamat-cabang').val(data.alamat_cabang);
        $('#js-jumlah-karyawan').val(data.jumlah_karyawan);
        $('#js-kode-cabang').val(data.kode_cabang);

        $('#js-cabang-form').attr('data-edit', 'true');
        $('#js-submit-button').text('Ubah');
        $('#js-cabang-modal-form').modal('show');
      });
  }

  const branchFormAction = (e) => {
    e.preventDefault();

    var formData = new FormData($('#js-cabang-form')[0]);

    let payload = {
      data: formData,
    }

    let formEdit = $('#js-cabang-form').attr('data-edit');

    if (formEdit) {
      payload.id = _idCabang;
      branchStore.updateBranch(payload)
        .then(res => {
          if (res.status == 200) {
            getBranch();
          }
        })
    } else {
      branchStore.addBranch(payload)
        .then(res => {
          if (res.status == 201) {
            getBranch();
          }
        })
    }
  }

  const showBranchModal = (branchId) => {
    branchStore.detailBranch(branchId).then((res) => {
      data = res.data

      $('.js-username-cabang').text(data.username);
      $('.js-nama-cabang').text(data.nama_cabang);
      $('.js-alamat-cabang').text(data.alamat_cabang);
      $('.js-jumlah-karyawan').text(data.jumlah_karyawan);
      $('.js-gambar-karyawan').attr("src", data.gambar_karyawan);
      $('.js-kode-cabang').text(data.kode_cabang);

      $('#js-cabang-modal-detail').modal('show');
    });
  }

  const deleteBranch = (idCabang) => {
    branchStore.detailBranch(idCabang)
      .then(res => {
        data = res.data;

        $swal({
            title: "Anda yakin?",
            text: `Cabang ${data.nama_cabang} akan dihapus selamanya!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              branchStore.destroyBranch(idCabang)
                .then(res => {
                  $swal("Cabang Berhasil Dihapus!", {
                    icon: "success",
                  });
                  getBranch();
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
              $swal("Cabang Batal Dihapus!");
            }
          });
      });
  }

  const populateTable = (data) => {
    tableCabang.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableCabang.row.add([
        number,
        item.nama_cabang,
        item.alamat_cabang,
        item.jumlah_karyawan,
        item.kode_cabang,
        `<button type="button" class="btn btn-sm btn-primary"
          onclick="showBranchModal(${item.cabang_id})"><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-sm btn-success"
          onclick="openEditForm(${item.cabang_id})">
          <i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-sm btn-danger"
          onclick="deleteBranch(${item.cabang_id})">
          <i class="fas fa-trash"></i></button>`
      ]).draw();
      number++;
    });
  }

  // dummy function for get dummy products data
  // will be deleted on next development

  const getBranch = () => {
    branchStore.allBranch().then((res) => {
      branchData = res.data;
      populateTable(branchData);
    });
  }
</script>
@endsection