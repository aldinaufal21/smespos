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
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
              <li class="nav-item col">
                <a class="nav-link active" id="konsumen-tab" data-toggle="tab" href="#js-konsumen" role="tab" aria-controls="js-konsumen" aria-selected="true">Konsumen</a>
              </li>
              <li class="nav-item col">
                <a class="nav-link" id="umkm-tab" data-toggle="tab" href="#js-umkm" role="tab" aria-controls="js-umkm" aria-selected="false">UMKM</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="js-konsumen" role="tabpanel" aria-labelledby="konsumen-tab">
                <div class="py-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Buat Akun Konsumen</h1>
                  </div>
                  <form class="user" id="js-konsumen-regis-form" onsubmit="konsumenRegis(event)">
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
              <div class="tab-pane fade" id="js-umkm" role="tabpanel" aria-labelledby="umkm-tab">
                <div class="py-5">
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
    </div>
  </div>

</div>
@endsection

@section('extra_script')
<script>
  const doLogin = (e) => {
    e.preventDefault();

    let data = {
      username: $('#js-username').val(),
      password: $('#js-password').val(),
    };

    const payload = {
      data: data
    };

    loginStore.doLogin(payload);
  }

  const konsumenRegis = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-konsumen-regis-form'));

    let payload = {
      data: formData,
    }

    registrationStore.konsumen(payload);
  }
  
  const umkmRegis = (e) => {
    e.preventDefault();

    var formData = new FormData($('#js-umkm-regis-form')[0]);

    let payload = {
      data: formData,
    }

    console.log(payload.data);

    registrationStore.umkm(payload);
  }
</script>
@endsection