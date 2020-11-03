@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
  </div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Karyawan</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
        <button class="btn btn-primary" id="js-btn-tambah-karyawan" onclick="openCreateForm()">
          <i class="fas fa-download fa-sm text-white-50"></i> Tambah Karyawan
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-karyawan" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Tanggal Bergabung</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Tanggal Bergabung</th>
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
<div class="modal fade" id="js-karyawan-modal-detail" tabindex="-1" role="dialog" aria-labelledby="karyawanModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="karyawanModal">Karyawan Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Page Content -->
        <div class="container">

          <!-- Portfolio Item Heading -->
          <h1 class="my-4">
            <span class="js-nama-karyawan">Nama Karyawan</span>
          </h1>

          <!-- Portfolio Item Row -->
          <div class="row">

            <div class="col-md-8">
              <img class="img-fluid js-gambar-karyawan" src="" alt="">
            </div>

            <div class="col-md-4">
              <h4 class="my-3">Alamat:</h4>
              <p>
                <span class="js-alamat-karyawan"></span>
              </p>
              <h4 class="my-3">Tanggal bergabung: </h4>
              <span class="js-tanggal-bergabung-karyawan"></span>
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
<div class="modal fade" id="js-karyawan-modal-form" tabindex="-1" role="dialog" aria-labelledby="karyawanModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="karyawanModalForm">Tambah Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-karyawan-form" data-edit="" onsubmit="employeeFormAction(event)" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="">
          <div class="form-group">
            <label class="control-label">Nama</label>
            <div>
              <input type="text" class="form-control input-lg" name="nama" id="js-nama-karyawan" placeholder="Nama Karyawan">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Alamat</label>
            <div>
              <textarea class="form-control input-lg" name="alamat" id="js-alamat-karyawan" cols="30" rows="5" placeholder="Alamat Karyawan"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Foto</label>
            <div>
              <input type="file" class="form-control input-lg" name="foto" accept="image/*">
            </div>
          </div>
          <!-- <div class="form-group">
            <label class="control-label">Cabang</label>
            <div>
              <select name="cabang_id" id="js-cabang-karyawan" class="form-control input-lg">
                <option value="">Pilih Cabang</option>
              </select>
            </div>
          </div> -->
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
  let tableKaryawan = null;
  let user = null;
  let _idKaryawan = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableKaryawan = $("#js-tabel-karyawan").DataTable();

    buttonTambahKaryawanCondition();

    getEmployee();
    // getBranch();
  });

  const openCreateForm = () => {
    $('#js-karyawan-form').attr('data-edit', '');
    $('#js-submit-button').text('Tambah');
    $('#js-karyawan-modal-form').modal('show');
  }

  const openEditForm = (idKaryawan) => {
    _idKaryawan = idKaryawan;
    employeeStore.detailEmployee(idKaryawan)
      .then(res => {
        data = res.data;

        $('#js-nama-karyawan').val(data.nama);
        $('#js-alamat-karyawan').val(data.alamat);

        $('#js-karyawan-form').attr('data-edit', 'true');
        $('#js-submit-button').text('Ubah');
        $('#js-karyawan-modal-form').modal('show');
      });
  }

  const employeeFormAction = (e) => {
    e.preventDefault();

    var formData = new FormData($('#js-karyawan-form')[0]);

    let payload = {
      data: formData,
    }

    let formEdit = $('#js-karyawan-form').attr('data-edit');

    if (formEdit) {
      payload.id = _idKaryawan;
      employeeStore.updateEmployee(payload)
        .then(res => {
          if (res.status == 200) {
            getEmployee();
          }
        })
    } else {
      employeeStore.addEmployee(payload)
        .then(res => {
          if (res.status == 201) {
            getEmployee();
          }
        })
    }
  }

  const showEmployeeModal = (employeeId) => {
    employeeStore.detailEmployee(employeeId).then((res) => {
      data = res.data

      $('.js-nama-karyawan').text(data.nama);
      $('.js-alamat-karyawan').text(data.alamat);
      $('.js-tanggal-bergabung-karyawan').text(data.tanggal_bergabung);
      $('.js-gambar-karyawan').attr("src", data.foto);

      $('#js-karyawan-modal-detail').modal('show');
    });
  }

  const deleteEmployee = (idKaryawan) => {
    employeeStore.detailEmployee(idKaryawan)
      .then(res => {
        data = res.data;

        $swal({
            title: "Anda yakin?",
            text: `Karyawan ${data.nama} akan dihapus selamanya!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              employeeStore.destroyEmployee(idKaryawan)
                .then(res => {
                  $swal("Karyawan Berhasil Dihapus!", {
                    icon: "success",
                  });
                  getEmployee();
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
              $swal("Karyawan Batal Dihapus!");
            }
          });
      });
  }

  const tableActionButtons = (item) => {
    if (user.user.role == 'umkm') {
      return `
        <button type="button" class="btn btn-sm btn-primary"
          onclick="showEmployeeModal(${item.karyawan_id})">
          <i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-sm btn-success"
          onclick="openEditForm(${item.karyawan_id})">
          <i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-sm btn-danger"
          onclick="deleteEmployee(${item.karyawan_id})">
          <i class="fas fa-trash"></i></button>`;
    } else {
      return `
        <button type="button" class="btn btn-sm btn-primary"
          onclick="showEmployeeModal(${item.karyawan_id})">
          <i class="fas fa-eye"></i></button>`;
    }
  }

  const buttonTambahKaryawanCondition = () => {
    if (user.user.role != 'umkm') {
      $('#js-btn-tambah-karyawan').hide();
    } else {
      $('#js-btn-tambah-karyawan').show();
    }
  }

  const populateTable = (data) => {
    tableKaryawan.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableKaryawan.row.add([
        number,
        item.nama,
        item.alamat,
        item.tanggal_bergabung,
        tableActionButtons(item)
      ]).draw();
      number++;
    });
  }

  const populateOptions = (data) => {
    let $dropdown = $('#js-cabang-karyawan');
    $dropdown.empty();
    $dropdown.append($("<option />").val("").text("Pilih Cabang"));

    $.each(data, function() {
      $dropdown.append($("<option />").val(this.cabang_id).text(this.nama_cabang));
    });
  }

  const getEmployee = () => {
    employeeStore.allEmployee().then((res) => {
      employeeData = res.data;
      populateTable(employeeData);
    });
  }

  const getBranch = () => {
    branchStore.allBranch().then((res) => {
      branchData = res.data;
      populateOptions(branchData);
    });
  }
</script>
@endsection