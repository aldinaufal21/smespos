@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
</style>
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Penjualan</h1>
    {{-- <form action="{{ route('report.download') }}" method="post">
      @csrf
      <input type="hidden" id="js-role" name="role" value="">
      <input type="hidden" id="js-id_cabang" name="cabang_id" value="">
      <input type="hidden" id="js-id_umkm" name="umkm_id" value="">
      <input type="hidden" id="js-dari_bulan" name="dari_bulan" value="">
      <input type="hidden" id="js-sampai_bulan" name="sampai_bulan" value="">

      <button class="btn btn-primary" id="js-button-download" disabled>
        <i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan
      </button>
    </form> --}}
  </div>
  <div class="row">
    <div class="col-3">
      <div class="row">
        <div class="col">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Periode Laporan (bulan)</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <form role="form" id="js-filter-form" action="{{ route('kasir.report_result') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                  <input type="text" name="periode" class="form-control js-month-datepicker" placeholder="Pilih Periode Per Bulan" aria-label="Periode" aria-describedby="calendar-addon" readonly>
                  <input type="hidden" name="id_kasir" id="form-kasir-id" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary float-right" value="Filter">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Periode Laporan (rentang waktu)</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <form role="form" id="js-filter-form" action="{{ route('kasir.report_result') }}" method="POST">
                @csrf
                <input type="hidden" name="id_kasir" id="form-kasir-id-2" class="form-control">
                <div class="input-group mb-3">
                  <div class="row mb-3">
                    <div class="input-group">
                      <input type="text" name="mulai_periode" class="form-control js-date-datepicker" placeholder="Mulai" aria-label="Periode" aria-describedby="calendar-addon" readonly>
                      <div class="input-group-append">
                        <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-group">
                      <input type="text" name="selesai_periode" class="form-control js-date-datepicker" placeholder="Selesai" aria-label="Periode" aria-describedby="calendar-addon" readonly>
                      <div class="input-group-append">
                        <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary float-right" value="Filter">
                </div>
              </form>
            </div>
          </div>
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
      <div class="card shadow mb-4" id="js-total-pendapatan-card" style="display: none;">
        <div class="card-body">
          <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
            <span id="js-pendapatan-bulan"></span>
          </div>
          Total Pendapatan Bulan <span id="js-teks-pendapatan-bulan"></span>
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
  $auth.needRole(['kasir']);

  $moment.locale('id');
  let tableDailyTransaction = null;
  let user = $auth.userCredentials();
  let _idKasir = user.kasir.kasir_id;

  console.log(_idKasir);

  const formIdKasir = document.getElementById('form-kasir-id').value = _idKasir;
  const formIdKasir2 = document.getElementById('form-kasir-id-2').value = _idKasir;

  let reportTable = null;
  let umkmCabang = null;
  let downloadButton = null;

  $(document).ready(() => {
    let shouldStartDate = null;

    $(".js-month-datepicker").datepicker({
      format: "yyyy-mm",
      viewMode: "months",
      minViewMode: "months",
      startDate: $helper.yearMonthDateFormat(shouldStartDate),
      endDate: new Date(),
    });

    $(".js-date-datepicker").datepicker({
      format: "yyyy-mm-dd",
      viewMode: "days",
      minViewMode: "days",
      endDate: new Date(),
    });
  });
</script>
@endsection