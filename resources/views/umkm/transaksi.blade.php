@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi UMKM</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">UMKM</h6>
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

  <div class="card shadow mb-4" id="js-transaksi-umkm-card" style="display: none;">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Transaksi UMKM</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item collapse-button" href="javascript:void(0)" onclick="toggleTransaksiUmkmCard(event)">Sembunyikan</a>
          <a class="dropdown-item close-button" href="javascript:void(0)" onclick="closeTransaksiUmkmCard(event)">Tutup</a>
        </div>
      </div>
    </div>
    <div class="card-body collapse show" id="js-transaksi-umkm-card-body">
      <div class="row">
        <div class="col-3">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Per</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <form role="form" id="js-filter-form" onsubmit="filterReport(event)">
                <div class="input-group mb-3">
                  <input 
                    type="text" 
                    name="mulai_bulan" 
                    class="form-control js-month-datepicker" 
                    placeholder="Dari Bulan" 
                    aria-label="Dari Bulan" 
                    aria-describedby="calendar-addon"
                    readonly
                  >
                  <div class="input-group-append">
                    <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input 
                    type="text" 
                    name="sampai_bulan" 
                    class="form-control js-month-datepicker" 
                    placeholder="Sampai Bulan" 
                    aria-label="Dari Bulan" 
                    aria-describedby="calendar-addon"
                    readonly
                  >
                  <div class="input-group-append">
                    <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary float-right">
                    Filter
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-9">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Terjual</h6>
            </div>
            <div class="card-body">
              <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
              </div>
              <div class="table-responsive">
                <table class="table" id="js-report-table" class="display" style="width:100%"></table>
              </div>
            </div>
          </div>
        </div>
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
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
  let tableUmkmPending = null;
  let tableApprovedUmkm = null;
  let user = null;
  let _umkmId = null;

  let reportTable = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableUmkmPending = $("#js-tabel-pendaftaran-umkm").DataTable();
    tableApprovedUmkm = $("#js-tabel-umkm-disetujui").DataTable();

    getApprovedUmkm();
  });

  const getApprovedUmkm = () => {
    umkmStore.approvedUmkm().then((res) => {
      approvedUmkm = res.data;
      populateApprovedTable(approvedUmkm);
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
        `<button type="button" class="btn btn-sm btn-primary mt-2"
          onclick="showUmkmModal(${item.umkm_id})">
          Detail</button>
        <button type="button" class="btn btn-sm btn-success mt-2"
          onclick="showUmkmTransaksi(${item.umkm_id})">
          Detail Transaksi</button>`
      ]).draw();
      number++;
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

  const showUmkmTransaksi = (umkmId) => {
    _umkmId = umkmId;
    umkmStore.detailUmkm(umkmId).then((res) => {
      data = res.data

      shouldStartDate = data.tanggal_bergabung;

      $(".js-month-datepicker").datepicker({
        format: "yyyy-mm",
        viewMode: "months",
        minViewMode: "months",
        startDate: $helper.yearMonthDateFormat(shouldStartDate),
        endDate: new Date(),
      });

      initTransaksiDataTable();
      getReportData(umkmId, null, null);

      $('#js-transaksi-umkm-card').show();

      $([document.documentElement, document.body]).animate({
        scrollTop: $("#js-transaksi-umkm-card").offset().top
      }, 1000);
    });
  }

  const initTransaksiDataTable = (columns = null, rows = null) => {
    if (columns || rows) {
      $('#js-report-table').show();
      reportTable = $('#js-report-table').DataTable({
        dom: "Bfrtip",
        data: rows,
        columns: columns,
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        fixedColumns: {
          leftColumns: 1,
          rightColumns: 1
        },
        retrieve: true,
      });
    }
  }

  const getReportData = (umkmId, startMonth = null, endMonth = null) => {
    reportStore.monthlyUmkm(umkmId, startMonth, endMonth)
      .then((res) => {
        showReports(res.data);
        $ui.toggleButtonLoading($('#js-filter-form'), false);
      });
  }

  const showReports = (data) => {
    let columns = [];
    let body = [];

    // initiate left header
    columns.push({
      'title': "Produk"
    });

    data.bulan.forEach(item => {
      columns.push({
        'title': item
      });
    });

    data.report_data.forEach(item => {
      let arr = [];
      arr.push(item.produk.nama_produk);

      item.report.forEach(reportItem => {
        if (reportItem.data) {
          arr.push(reportItem.data.jumlah);
        } else {
          arr.push(0);
        }
      });
      body.push(arr);
    });


    if (reportTable) {
      reportTable.clear().destroy();
      $('#js-report-table').empty();
    }
    initTransaksiDataTable(columns, body);
  }

  const filterReport = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-filter-form'));
    $ui.toggleButtonLoading($('#js-filter-form'));

    let startMonth = formData.mulai_bulan != "" ? formData.mulai_bulan : null;
    let endMonth = formData.sampai_bulan != "" ? formData.sampai_bulan : null;

    $('#js-dari_bulan').val(startMonth);
    $('#js-sampai_bulan').val(endMonth);

    getReportData(_umkmId, startMonth, endMonth);
  }

  const toggleTransaksiUmkmCard = (e) => {
    $("#js-transaksi-umkm-card-body").collapse('toggle');
  }
  const closeTransaksiUmkmCard = (e) => {
    $("#js-transaksi-umkm-card").hide();
  }
</script>
@endsection