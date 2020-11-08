@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pendaftaran UMKM</h1>
    <button class="btn btn-primary" id="js-btn-tambah-karyawan" onclick="openCreateForm()">
      <i class="fas fa-download fa-sm text-white-50"></i> Daftarkan UMKM
    </button>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Pendaftaran Pending</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-pendaftaran-umkm" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama UMKM</th>
              <th>Deskripsi</th>
              <th>Alamat</th>
              <th>Nomor KTP Pemilik</th>
              <th>Tanggal Pendaftaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama UMKM</th>
              <th>Deskripsi</th>
              <th>Alamat</th>
              <th>Nomor KTP Pemilik</th>
              <th>Tanggal Pendaftaran</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Pendaftaran Disetujui</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-umkm-disetujui" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama UMKM</th>
              <th>Deskripsi</th>
              <th>Alamat</th>
              <th>Nomor KTP Pemilik</th>
              <th>Tanggal Pendaftaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama UMKM</th>
              <th>Deskripsi</th>
              <th>Alamat</th>
              <th>Nomor KTP Pemilik</th>
              <th>Tanggal Pendaftaran</th>
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
<div class="modal fade" id="js-detail-umkm-modal" tabindex="-1" role="dialog" aria-labelledby="umkmModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="umkmModal">Detail UMKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Page Content -->
        <div class="container">

          <!-- Portfolio Item Heading -->
          <h1 class="my-4">
            <span class="js-nama-umkm">Nama UMKM</span>
          </h1>

          <!-- Portfolio Item Row -->
          <div class="row">

            <div class="col-md-8">
              <img class="img-fluid js-gambar-umkm" src="" alt="">
            </div>

            <div class="col-md-4">
              <h4 class="my-3">Alamat:</h4>
              <p>
                <span class="js-alamat-umkm"></span>
              </p>
              <h4 class="my-3">Deskripsi:</h4>
              <p>
                <span class="js-deskripsi-umkm"></span>
              </p>
              <h4 class="my-3">Tanggal Bergabung:</h4>
              <p>
                <span class="js-tanggal-bergabung"></span>
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
<div class="modal fade" id="js-umkm-modal-form" tabindex="-1" role="dialog" aria-labelledby="cabangModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cabangModalForm">Tambah UMKM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-umkm-form" data-edit="" onsubmit="branchFormAction(event)" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="">
          <h4>Data Akun UMKM</h4>
          <div class="form-group">
            <label class="control-label">Username</label>
            <div>
              <input type="text" class="form-control input-lg" name="username" placeholder="Username">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password_confirmation" placeholder="Konfirmasi Password">
            </div>
          </div>
          <hr>
          <h4>Data UMKM</h4>
          <div class="form-group">
            <label class="control-label">Nomor KTP Pemilik</label>
            <div>
              <input type="text" class="form-control input-lg" name="no_ktp" placeholder="Nomor KTP Pemilik">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Nama</label>
            <div>
              <input type="text" class="form-control input-lg" name="nama_umkm" placeholder="Nama UMKM">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Deskripsi</label>
            <div>
              <textarea class="form-control input-lg" name="deskripsi" cols="30" rows="10" placeholder="Deskripsi UMKM"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Alamat</label>
            <div>
              <textarea class="form-control input-lg" name="alamat_umkm" cols="30" rows="5" placeholder="Alamat Lokasi UMKM"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Gambar</label>
            <div>
              <input type="file" class="form-control input-lg" name="gambar" accept="image/*">
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
  let tableUmkmPending = null;
  let tableApprovedUmkm = null;
  let user = null;
  let _idCabang = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableUmkmPending = $("#js-tabel-pendaftaran-umkm").DataTable();
    tableApprovedUmkm = $("#js-tabel-umkm-disetujui").DataTable();

    getPendingUmkm();
    getApprovedUmkm();
  });

  const openCreateForm = () => {
    $('#js-umkm-form').attr('data-edit', '');
    $('#js-submit-button').text('Tambah');
    $('#js-umkm-modal-form').modal('show');
  }

  const branchFormAction = (e) => {
    e.preventDefault();

    var formData = new FormData($('#js-umkm-form')[0]);

    let payload = {
      data: formData,
    }

    let formEdit = $('#js-umkm-form').attr('data-edit');

    umkmStore.addUmkm(payload)
      .then(res => {
        if (res.status == 201) {
          getApprovedUmkm();
        }
      })
  }

  const approveModal = (umkmId) => {
    umkmStore.detailUmkm(umkmId)
      .then(res => {
        data = res.data;

        $swal({
            title: "Anda yakin?",
            text: `Anda Akan Menyetujui UMKM ${data.nama_umkm} untuk Bergabung!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              umkmStore.approveUmkm(umkmId)
                .then(res => {
                  $swal("UMKM Disetujui!", {
                    icon: "success",
                  });
                  getPendingUmkm();
                  getApprovedUmkm();
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
              $swal("UMKM Batal Disetujui!");
            }
          });
      });
  }

  const showUmkmModal = (umkmId) => {
    umkmStore.detailUmkm(umkmId).then((res) => {
      data = res.data

      $('.js-nama-umkm').text(data.nama_umkm);
      $('.js-alamat-umkm').text(data.alamat_umkm);
      $('.js-deskripsi-umkm').text(data.deskripsi);
      $('.js-tanggal-bergabung').text(data.tanggal_bergabung);
      $('.js-gambar-umkm').attr("src", data.gambar);

      $('#js-detail-umkm-modal').modal('show');
    });
  }

  const populatePendingTable = (data) => {
    tableUmkmPending.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableUmkmPending.row.add([
        number,
        item.nama_umkm,
        item.deskripsi,
        item.alamat_umkm,
        item.no_ktp,
        item.tanggal_pendaftaran,
        `<button type="button" class="btn btn-sm btn-primary"
          onclick="showUmkmModal(${item.umkm_id})">
          Detail</button>
        <button type="button" class="btn btn-sm btn-success"
          onclick="approveModal(${item.umkm_id})">
          Setujui</button>`
      ]).draw();
      number++;
    });
  }

  const populateApprovedTable = (data) => {
    tableApprovedUmkm.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableApprovedUmkm.row.add([
        number,
        item.nama_umkm,
        item.deskripsi,
        item.alamat_umkm,
        item.no_ktp,
        item.tanggal_pendaftaran,
        `<button type="button" class="btn btn-sm btn-primary"
        onclick="showUmkmModal(${item.umkm_id})">
        Detail</button>`
      ]).draw();
      number++;
    });
  }

  const getPendingUmkm = () => {
    umkmStore.pendingUmkm().then((res) => {
      pendingUmkm = res.data;
      populatePendingTable(pendingUmkm);
    });
  }

  const getApprovedUmkm = () => {
    umkmStore.approvedUmkm().then((res) => {
      approvedUmkm = res.data;
      populateApprovedTable(approvedUmkm);
    });
  }
</script>
@endsection