@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kategori UMKM</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-umkm" width="100%" cellspacing="0">
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

  <div class="card shadow mb-4" id="js-kategori-card" style="display: none;">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Kategori <span class="js-nama-umkm"></span></h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item collapse-button" href="javascript:void(0)" onclick="toggleKategoriCard(event)">Sembunyikan</a>
          <a class="dropdown-item close-button" href="javascript:void(0)" onclick="closeKategoriCard(event)">Tutup</a>
        </div>
      </div>
    </div>
    <div class="card-body collapse show" id="js-kategori-card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-kategori" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kategori</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama Kategori</th>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
        </table>
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
  let tableUmkm = null;
  let tableKategori = null;
  let user = null;
  let _idCabang = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableUmkm = $("#js-tabel-umkm").DataTable();
    tableKategori = $("#js-tabel-kategori").DataTable();


    $("#js-kategori-card-body").on('hide.bs.collapse', function() {
      $('.collapse-button').text('Tampilkan');
    });

    $("#js-kategori-card-body").on('show.bs.collapse', function() {
      $('.collapse-button').text('Sembunyikan');
    });

    getApprovedUmkm();
  });

  const toggleKategoriCard = (e) => {
    $("#js-kategori-card-body").collapse('toggle');
  }
  const closeKategoriCard = (e) => {
    $("#js-kategori-card").hide();
  }

  const showKategori = (umkmId) => {
    umkm.detailUmkm(umkmId).then((res) => {
      let data = res.data;
      $('.js-nama-umkm').text(data.nama_umkm);
    });

    categoryStore.UmkmsCategory(umkmId)
      .then((res) => {
        let data = res.data;

        populateKategoriTable(data);

        $('#js-kategori-card').show();

        $([document.documentElement, document.body]).animate({
          scrollTop: $("#js-kategori-card").offset().top
        }, 1000);
      });
  }

  const populateUmkmTable = (data) => {
    tableUmkm.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableUmkm.row.add([
        number,
        item.nama_umkm,
        item.deskripsi,
        item.alamat_umkm,
        item.no_ktp,
        item.tanggal_pendaftaran,
        `<button type="button" class="btn btn-sm btn-primary"
        onclick="showKategori(${item.umkm_id})">
        List Kategori</button>`
      ]).draw();
      number++;
    });
  }

  const populateKategoriTable = (data) => {
    tableKategori.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableKategori.row.add([
        number,
        item.nama_kategori,
      ]).draw();
      number++;
    });
  }

  const getApprovedUmkm = () => {
    umkm.approvedUmkm().then((res) => {
      let dataUmkm = res.data;
      populateUmkmTable(dataUmkm);
    });
  }
</script>
@endsection