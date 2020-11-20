@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">User</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right"></div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-user" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Role</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Role</th>
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
<div class="modal fade" id="js-user-modal-form" tabindex="-1" role="dialog" aria-labelledby="cabangModalForm" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cabangModalForm">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-user-form" onsubmit="userFormAction(event)">
          <input type="hidden" name="_token" value="">
          <h4>Reset Password User</h4>
          <div class="form-group">
            <label class="control-label">Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password" id="js-password-user" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Konfirmasi Password</label>
            <div>
              <input type="password" class="form-control input-lg" name="password_confirmation" id="js-password-confirm-user" placeholder="Konfirmasi Password">
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
  let tableUser = null;
  let user = null;
  let _idUser = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableUser = $("#js-tabel-user").DataTable();

    getUsers();
  });

  const openEditForm = (idUser) => {
    _idUser = idUser;
    userStore.detailUser(idUser)
      .then(res => {
        data = res.data;

        $('#js-username-user').val(data.username);

        $('#js-submit-button').text('Ubah');
        $('#js-user-modal-form').modal('show');
      });
  }

  const userFormAction = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-user-form'));

    let payload = {
      id: _idUser,
      data: formData,
    }

    userStore.resetPasswordUser(payload)
      .then(res => {
        if (res.status == 200) {
          getUsers();
          $helper.resetForm($('#js-user-form'));
        }
      })
  }

  const populateTable = (data) => {
    tableUser.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableUser.row.add([
        number,
        item.username,
        __roleLabelLabel(item.role),
        __resetPasswordButton(item.id)
      ]).draw();
      number++;
    });

    function __roleLabelLabel(role) {
      let label = '';
      switch (role) {
        case 'pengelola':
          label = 'badge-danger'
          break;
        case 'umkm':
          label = 'badge-info'
          break;
        case 'cabang':
          label = 'badge-primary'
          break;
        case 'kasir':
          label = 'badge-warning'
          break;
        case 'konsumen':
          label = 'badge-success'
          break;
      }

      return `<span class="badge ${label}">${$helper.humanize(role)}</span>`;
    }

    function __resetPasswordButton(id) {
      if (user.user.id == id) {
        return '';
      }

      return `<button type="button" class="btn btn-sm btn-primary"
          onclick="openEditForm(${id})">
          Reset Password</button>`;
    }
  }

  const getUsers = () => {
    userStore.allUsers().then((res) => {
      userData = res.data;
      populateTable(userData);
    });
  }
</script>
@endsection