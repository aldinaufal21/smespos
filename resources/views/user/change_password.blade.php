@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Atur Ulang Password</h1>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Atur Ulang Password</h6>
    </div>
    <div class="card-body">
      <form role="form" id="js-user-form" onsubmit="userFormAction(event)">
        <input type="hidden" name="_token" value="">
        <div class="form-group">
          <label class="control-label">Password Saat Ini</label>
          <div>
            <input type="password" class="form-control input-lg" name="existing_password" id="js-password-user" placeholder="Password Saat Ini">
          </div>
        </div>
        <hr>
        <div class="form-group">
          <label class="control-label">Password Baru</label>
          <div>
            <input type="password" class="form-control input-lg" name="new_password" id="js-password-user" placeholder="Password Baru">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label">Konfirmasi Password</label>
          <div>
            <input type="password" class="form-control input-lg" name="new_password_confirmation" id="js-password-confirm-user" placeholder="Konfirmasi Password">
          </div>
        </div>
        <div class="form-group">
          <button type="submit" id="js-submit-button" class="btn btn-primary float-right">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
  let user = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
  });

  const userFormAction = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-user-form'));
    $ui.toggleButtonLoading($('#js-user-form'));

    let payload = {
      data: formData,
    }

    userStore.selfResetPassword(payload)
      .then(res => {
        if (res.status == 200) {
          getUsers();
          $helper.resetForm($('#js-user-form'));
          $ui.toggleButtonLoading($('#js-user-form'), false);
        }
      })
  }
</script>
@endsection