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
    <form action="{{ route('report.download') }}" method="post">
      @csrf
      <input type="hidden" id="js-role" name="role" value="">
      <input type="hidden" id="js-id_cabang" name="cabang_id" value="">
      <input type="hidden" id="js-id_umkm" name="umkm_id" value="">
      <input type="hidden" id="js-dari_bulan" name="dari_bulan" value="">
      <input type="hidden" id="js-sampai_bulan" name="sampai_bulan" value="">

      <button class="btn btn-primary" id="js-button-download" disabled>
        <i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan
      </button>
    </form>
  </div>
  <div class="row">
    <div class="col-3">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Periode Laporan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <form role="form" id="js-filter-form" onsubmit="filterReport(event)">
            <div class="input-group mb-3">
              <input 
                type="text"
                name="periode" 
                class="form-control js-month-datepicker" 
                placeholder="Periode" 
                aria-label="Periode" 
                aria-describedby="calendar-addon" 
                readonly>
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
          <div class="table-responsive">
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
  let umkmCabang = null;
  let downloadButton = null;

  $(document).ready(() => {
    $('#js-role').val($_user.user.role);

    let shouldStartDate = null;

    switch ($_user.user.role) {
      case 'umkm':
        shouldStartDate = $_user.umkm.tanggal_bergabung;
        $('#js-id_umkm').val($_user.umkm.umkm_id);
        break;

      case 'cabang':
        shouldStartDate = $_user.user.created_at;
        $('#js-id_umkm').val($_user.cabang.umkm_id);
        $('#js-id_cabang').val($_user.cabang.cabang_id);
        break;

      default:
        return;
    }

    $(".js-month-datepicker").datepicker({
      format: "yyyy-mm",
      viewMode: "months",
      minViewMode: "months",
      startDate: $helper.yearMonthDateFormat(shouldStartDate),
      endDate: new Date(),
    });

    initDataTable();
    detectFilterChanges();

    downloadButton = $('#js-button-download');
    downloadButton.prop('disabled', true);
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
    let role = $_user.user.role;

    switch (role) {
      case 'umkm':
        reportStore.monthlyUmkm($_user.umkm.umkm_id, startMonth, endMonth)
          .then((res) => {
            showReports(res.data);
            $ui.toggleButtonLoading($('#js-filter-form'), false, 'Filter');
          });
        break;

      case 'cabang':
        reportStore.monthlyCabang($_user.cabang.cabang_id, startMonth, endMonth)
          .then((res) => {
            showReports(res.data);
            $ui.toggleButtonLoading($('#js-filter-form'), false, 'Filter');
          });
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
    initDataTable(columns, body);
  }

  const filterReport = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-filter-form'));
    console.log('HAI');
    $ui.toggleButtonLoading($('#js-filter-form'));

    if (formData.periode == "" || formData.periode == null) {
      let err = {
        response: {
          status: 401,
          data: {
            message: "Pilih periode!"
          }
        }
      };

      $ui.errorModal(err);
      return;
    }

    let startMonth = formData.periode;
    let endMonth = formData.periode;

    $('#js-dari_bulan').val(startMonth);
    $('#js-sampai_bulan').val(endMonth);

    getReportData(startMonth, endMonth);
  }

  const detectFilterChanges = () => {
    $('.js-month-datepicker').change((e) => {
      let periode = $('.js-month-datepicker').val();

      $('#js-dari_bulan').val(periode);
      $('#js-sampai_bulan').val(periode);
      downloadButton.prop('disabled', false);
    })
  }

  const __pullUmkmCabang = async (umkmId) => {
    let umkm = await umkmStore.detailUmkm(umkmId);
    umkmCabang = umkm.data;
  }

  const __getUmkmCabang = () => {
    return umkmCabang;
  }
</script>
@endsection