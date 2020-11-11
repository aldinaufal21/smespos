@extends('../layouts.auth')

@section('extra_head')
  <style media="screen">
    .bg-login-image{
      background: url(https://images.unsplash.com/photo-1602665742701-389671bc40c0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80);
      background-position: center;
      background-size: cover;
    }
  </style>
@endsection

@section('content')
<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <form class="user" onsubmit="doLogin(event)">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" name="username" id="js-username" placeholder="Your Username">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" name="password" id="js-password" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="{{ route('register') }}">Buat akun!</a>
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
</script>
@endsection
