@extends('../layouts.auth')

@section('extra_head')
<style>
  .nav-item>a {
    text-align: center;
  }

  .form-control-user {
    border-radius: 0.5rem !important;
    padding: 0.9rem 0.4rem !important;
  }
  .bg-register-image {
    background: url(https://images.unsplash.com/photo-1602665742701-389671bc40c0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80);
    background-position: center;
    background-size: cover;
  }
</style>
@endsection

@section('content')
<div class="container">

  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
        <div class="col-lg-7">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Buat Akun UMKM</h1>
            </div>
            <form class="user" id="js-umkm-regis-form" enctype="multipart/form-data" onsubmit="umkmRegis(event)">
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control form-control-user" name="nama_umkm" placeholder="Nama UMKM">
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control form-control-user" name="no_ktp" placeholder="Nomor KTP Pemilik">
                </div>
              </div>
              <div class="form-group">
                <textarea name="alamat_umkm" class="form-control form-control-user" cols="30" rows="2" placeholder="Alamat Toko"></textarea>
              </div>
              <div class="form-group">
                <textarea name="deskripsi" class="form-control form-control-user" cols="30" rows="4" placeholder="Deskripsi Usaha"></textarea>
              </div>
              <div class="form-group row">
                <div class="col-sm-3 mb-3 mb-sm-0">
                  <label>Foto Toko</label>
                </div>
                <div class="col-sm-9">
                  <input type="file" name="gambar" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control form-control-user" name="username" placeholder="Username">
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" name="password_confirmation" placeholder="Ulangi Password">
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Daftarkan Akun
              </button>
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="{{ route('login') }}">Sudah memiliki akun? Login!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('extra_script')
<script>
  const umkmRegis = (e) => {
    e.preventDefault();

    var formData = new FormData($('#js-umkm-regis-form')[0]);

    let payload = {
      data: formData,
    }

    $ui.toggleButtonLoading($('#js-umkm-regis-form'));

    registrationStore.umkm(payload);
  }
</script>
@endsection