@extends('layouts.app')

@section('title', 'Demo')

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          Selamat Datang, <span class="js-username"></span>!
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

@section('extra_script')
<script>
  $(document).ready(() => {
    let user = $auth.userCredentials();
    if (user.user) {
      $('.js-username').text(user.user.username);
    } else {
      $('.js-username').text('Pengguna');
    }
  })
</script>
@endsection