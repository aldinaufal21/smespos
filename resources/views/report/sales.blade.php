@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
  .css-cust-responsive {
    /* overflow-y: auto; */
    /* max-height: 500px; */
  }
</style>
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Laporan Penjualan</h1>
    <button class="btn btn-primary">
      <i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan
    </button>
  </div>
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
              <input type="text" name="mulai_bulan" class="form-control js-month-datepicker" placeholder="Dari Bulan" aria-label="Dari Bulan" aria-describedby="calendar-addon">
              <div class="input-group-append">
                <span class="input-group-text" id="calendar-addon"><i class="fas fa-calendar-alt"></i></span>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="sampai_bulan" class="form-control js-month-datepicker" placeholder="Sampai Bulan" aria-label="Dari Bulan" aria-describedby="calendar-addon">
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
      <!-- <div class="card shadow mb-4 cabang-list" style="display: none;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Laporan UMKM</h6>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div>
              <select name="cabang_id" id="js-cabang-choice" class="form-control input-lg"></select>
            </div>
          </div>
        </div>
      </div> -->
    </div>
    <div class="col-9">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Terjual</h6>
        </div>
        <div class="card-body">
          <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
          </div>
          <div class="table-responsive css-cust-responsive">
            <table class="table" id="js-report-table" class="display" style="width:100%"></table>
          </div>
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
  let reportTable = null;
  $(document).ready(() => {
    $(".js-month-datepicker").datepicker({
      format: "yyyy-mm",
      viewMode: "months",
      minViewMode: "months",
      startDate: _user.umkm.tanggal_bergabung,
      endDate: new Date(),
    });

    initDataTable();
    getReportData(null, null);

    /**
     * component on change events
     */

    // select value on change
    // $('#js-cabang-choice').on('change', function() {
    //   idCabang = this.value;
    //   getReportData();
    // });
  });

  const initDataTable = (columns = null, rows = null) => {
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

  const getReportData = (startMonth = null, endMonth = null) => {
    let role = _user.user.role;

    switch (role) {
      case 'umkm':
        reportStore.monthlyUmkm(_user.umkm.umkm_id, startMonth, endMonth)
          .then((res) => {
            showReports(res.data);
          });
        break;

      case 'cabang':
        // 
        break;

      default:
        return;
    }
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
        arr.push(reportItem.data.jumlah);
      });
      body.push(arr);
    });


    if (reportTable) {
      reportTable.clear().destroy();
      $('#js-report-table').empty();
    }
    initDataTable(columns, body);
  }

  const filterReport = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-filter-form'));

    let startMonth = formData.mulai_bulan != "" ? formData.mulai_bulan : null;
    let endMonth = formData.sampai_bulan != "" ? formData.sampai_bulan : null;

    getReportData(startMonth, endMonth);

  }
</script>
@endsection