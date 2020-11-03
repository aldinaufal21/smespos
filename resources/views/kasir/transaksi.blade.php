@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">
  #content{
    background-color:#f2f2f2;
  }
</style>
@endsection

@section('content')
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Kasir</h1>
      <br>
      {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="row">
      <!-- Product list section start -->
      <div class="col-md-7">
        <div class="row">
          <div class="col-md-6">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-3 small" placeholder="Cari Barang..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Sayuran</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-light shadow-sm">makanan</a>
            <br><br>
          </div>
            @for ($i=0; $i < 10; $i++)
              <div class="col-md-4">
                <div class="card" style="width: 18rem; margin-bottom:20px;">
                  <img src="https://i1.wp.com/resepkoki.id/wp-content/uploads/2018/03/sayur-mayur-Cropped-1.jpg?w=800&ssl=1" class="card-img-top" alt="...">
                  <div class="card-body center">
                    <center>
                    <h5 class="card-title">Sayur Bayem</h5>
                    <p class="card-text"><b>5.000</b></p>
                    <a href="#" class="btn btn-success">+ Tambah Keranjang</a>
                    <center>
                  </div>
                </div>
              </div>
            @endfor
        </div>
      </div>
      <!-- Product list section end -->
      <div class="col-md-5">
        <div class="card shadow mb-12">
          <div class="card-header py-3">
            <center><h3 class="m-0 font-weight-bold text-primary">Total Barang</h3></center>
          </div>
          <div class="card-body">
            <p>Hi Usaha Bersama,</p>
            <div class="row">
              <div class="col-md-6">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('extra_script')
<!-- Page level plugins -->

<script>
  let user = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials

  });

</script>
@endsection
