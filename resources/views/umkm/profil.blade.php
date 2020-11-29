@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil UMKM</h1>
  </div>

  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Profil UMKM</h6>
        </div>
        <div class="card-body">
          <form role="form" id="js-umkm-form" onsubmit="umkmFormAction(event)">
            <div class="form-group">
              <label class="control-label">Nama UMKM</label>
              <input type="text" class="form-control form-control-user" name="nama_umkm" id="js-nama-umkm" placeholder="Nama UMKM" disabled>
            </div>
            <label class="control-label">Alamat Toko</label>
            <div class="form-group">
              <textarea name="alamat_umkm" id="js-alamat-toko" class="form-control form-control-user" cols="30" rows="2" placeholder="Alamat Toko"></textarea>
            </div>
            <div class="form-group">
              <label class="control-label">Deskripsi Usaha</label>
              <textarea name="deskripsi" id="js-deskripsi-usaha" class="form-control form-control-user" cols="30" rows="4" placeholder="Deskripsi Usaha"></textarea>
            </div>
            <div class="form-group">
              <label class="control-label">Foto Saat Ini</label>
                <img id="js-gambar-toko" class="img-fluid" alt="Foto Toko">
            </div>
            <div class="form-group row">
              <div class="col-sm-3 mb-3 mb-sm-0">
                <label>Foto Toko</label>
              </div>
              <div class="col-sm-9">
                <input type="file" name="gambar" class="form-control">
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label">Konfirmasi Password</label>
              <div>
                <input type="password" class="form-control input-lg" name="confirmation" id="js-confirmation" placeholder="Konfirmasi Password">
              </div>
            </div>
            <div class="form-group">
              <button type="submit" id="js-submit-button" class="btn btn-primary float-right">Ubah</button>
            </div>
          </form>
        </div>
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
  let user = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    setCurrentData();
  });

  const setCurrentData = () => {
    umkmStore.detailUmkm(user.umkm.umkm_id)
      .then((res) => {
        let data = res.data;

        $("#js-nama-umkm").val(data.nama_umkm);
        $("#js-alamat-toko").val(data.alamat_umkm);
        $("#js-deskripsi-usaha").val(data.deskripsi);
        $("#js-gambar-toko").attr('src', data.gambar);
      })
  }

  const umkmFormAction = (e) => {
    e.preventDefault();

    var formData = new FormData($('#js-umkm-form')[0]);

    let payload = {
      data: formData,
    }

    umkmStore.updateUmkm(payload)
      .then((res) => {
        $('#js-confirmation').val("");
        setCurrentData();
      });
  }
</script>
@endsection