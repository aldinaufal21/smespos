@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi Konsumen</h1>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Transaksi Konsumen</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-trankaksi" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Id Transaksi</th>
              <th>Konsumen</th>
              <th>Jenis Order</th>
              <th>Status</th>
              <th>Bukti Transfer</th>
              <th>Tanggal Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Id Transaksi</th>
              <th>Konsumen</th>
              <th>Jenis Order</th>
              <th>Status</th>
              <th>Bukti Transfer</th>
              <th>Tanggal Transaksi</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal bukti pembayaran -->
<div class="modal fade" id="js-bukti-pembayaran" tabindex="-1" role="dialog" aria-labelledby="buktiPembayaranModal" aria-hidden="true" style="z-index: 2001;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="buktiPembayaranModal">Bukti Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Page Content -->
        <div class="container">
          <div class="row">
            <div class="col">
              <img src="" class="img-fluid js-gambar-bukti">
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

<!-- Modal Tambah -->
<div class="modal fade" id="js-konfirmasi-transaksi" tabindex="-1" role="dialog" aria-labelledby="konfirmasiTransaksiForm" aria-hidden="true" style="z-index: 2000;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="konfirmasiTransaksiForm">Konfirmasi Transaksi
          <span class="js-nomor-transaksi"></span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- 
        transaksi_konsumen_id: 10
        nama_konsumen: "Bala Narpati"
        alamat: ...
        catatan_order: "Naon We Lah"
        jenis_order: "take_away"
        status: "siap diambil"
        total_biaya: 441888
        bukti_transfer: null
        tanggal_transaksi: "2020-11-14 05:48:56"
       -->
      <div class="modal-body">
        <div class="row">
          <div class="col-3">ID Transaksi</div>
          <div class="col-9"><span class="js-transaksi_konsumen_id"></span></div>
        </div>
        <div class="row">
          <div class="col-3">Nama Konsumen</div>
          <div class="col-9"><span class="js-nama_konsumen"></span></div>
        </div>
        <div class="row">
          <div class="col-3">Alamat Pengiriman</div>
          <div class="col-9"><span class="js-alamat"></span></div>
        </div>
        <div class="row">
          <div class="col-3">Catatan Order</div>
          <div class="col-9"><span class="js-catatan_order"></span></div>
        </div>
        <div class="row">
          <div class="col-3">Jenis Order</div>
          <div class="col-9"><span class="js-jenis_order"></span></div>
        </div>
        <div class="row">
          <div class="col-3">Status Order Saat Ini</div>
          <div class="col-9"><span class="js-status"></span></div>
        </div>
        <div class="row">
          <div class="col-3">Total Biaya</div>
          <div class="col-9"><span class="js-total_biaya"></span></div>
        </div>
        <div class="row">
          <div class="col-3">Bukti Pembayaran</div>
          <div class="col-9 js-bukti-pembayaran">
            <button type="button" class="btn btn-sm btn-primary js-btn-bukti">
              Lihat Bukti Transfer</button>
          </div>
        </div>
        <div class="row">
          <div class="col-3">Tanggal Transaksi</div>
          <div class="col-9"><span class="js-tanggal_transaksi"></span></div>
        </div>
        <hr>
        <form role="form" id="js-form-aksi" onsubmit="aksiTransaksi(event)">
          <input type="hidden" name="_token" value="">
          <div class="form-group">
            <label class="control-label">Status Menjadi</label>
            <div>
              <select name="aksi" id="js-status-pesanan" class="form-control input-lg">
                <option value="">Pilih Status</option>
              </select>
            </div>
          </div>
          <div class="form-group js-field-nomor-resi">
            <label class="control-label">Nomor Resi</label>
            <div>
              <input type="text" class="form-control input-lg" name="no_resi" id="js-nama-produk" placeholder="Nomor Resi">
            </div>
          </div>
          <!-- <div class="form-group">
            <label class="control-label">Tinggalkan Pesan</label>
            <div>
              <textarea class="form-control input-lg" name="deskripsi_produk" id="js-deskripsi-produk" cols="30" rows="10" placeholder="Deskripsi Produk"></textarea>
            </div>
          </div> -->
          <div class="form-group">
            <button type="submit" class="btn btn-primary float-right">Submit</button>
            <button type="reset" class="btn btn-warning float-right mr-2">
              Batal
            </button>
          </div>
        </form>
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
  let tableTransaksiKonsumen = null;
  let user = null;
  let _idTransaksiKonsumen = null;

  let listKategoriProduk = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tableTransaksiKonsumen = $("#js-tabel-trankaksi").DataTable();

    getTransaksi();
  });

  const getTransaksi = () => {
    transaksiStore.getTransaksi().then((res) => {
      dataTransaksi = res.data;
      populateTable(dataTransaksi);
    });
  }

  const populateTable = (data) => {
    const __buttonConfirm = (status, idTransaksi) => {
      if (status == 'selesai' || status == 'dibatalkan') {
        return `Transaksi ${status}`;
      }

      if (_user.user.role == 'umkm') {
        if (status == 'menunggu_verifikasi') {
          return `<button type="button" class="btn btn-sm btn-primary"
            onclick="aksiVerifikasi(${idTransaksi})">
            Verifikasi</button>`;
        } else if (status == 'belum_bayar') {
          return 'Menunggu Bukti Pembayaran';
        } else {
          return 'Transaksi Sudah Terverifikasi';
        }
      } else if (_user.user.role == 'cabang') {
        return `<button type="button" class="btn btn-sm btn-primary"
          onclick="modalKonfirmasi(${idTransaksi})">
          Konfirmasi</button>`;
      }
    }

    const __jenisOrderLabel = (jenisOrder) => {
      let label = '';
      switch (jenisOrder) {
        case 'take_away':
          label = 'badge-success'
          break;
        case 'delivery':
          label = 'badge-primary'
          break;
      }

      return `<span class="badge ${label}">${$helper.humanize(jenisOrder)}</span>`;
    }

    const __statusOrderLabel = (statusOrder) => {
      let label = '';
      // 'belum_bayar','menunggu_verifikasi','diantar','siap diambil','selesai','dibatalkan'
      switch (statusOrder) {
        case 'belum_bayar':
          label = 'badge-secondary'
          break;
        case 'menunggu_verifikasi':
          label = 'badge-info'
          break;
        case 'terverifikasi':
          label = 'badge-primary'
          break;
        case 'diantar':
          label = 'badge-warning'
          break;
        case 'siap diambil':
          label = 'badge-warning'
          break;
        case 'selesai':
          label = 'badge-success'
          break;
        case 'dibatalkan':
          label = 'badge-danger'
          break;
      }

      return `<span class="badge ${label}">${$helper.humanize(statusOrder)}</span>`;
    }

    tableTransaksiKonsumen.clear().draw();
    let number = 1;

    data.forEach(item => {
      tableTransaksiKonsumen.row.add([
        number,
        item.transaksi_konsumen_id,
        item.nama_konsumen,
        __jenisOrderLabel(item.jenis_order),
        __statusOrderLabel(item.status),
        _btnBuktiTransfer(item.bukti_transfer),
        item.tanggal_transaksi,
        __buttonConfirm(item.status, item.transaksi_konsumen_id)
      ]).draw();
      number++;
    });
  }

  const modalBuktiTransfer = (buktiTransfer) => {
    $('.js-gambar-bukti').attr('src', buktiTransfer);
    $('#js-bukti-pembayaran').modal('show');
  }

  const modalKonfirmasi = async (idTransaksi) => {
    _idTransaksiKonsumen = idTransaksi;
    let dataTransaksi = await transaksiStore.getDetailTransaksi(idTransaksi);
    dataTransaksi = dataTransaksi.data[0];

    let statusText = null;
    if (dataTransaksi.status == 'diantar') {
      statusText = `${dataTransaksi.status} - ${dataTransaksi.no_resi} (No. Resi)`;
    } else {
      statusText = dataTransaksi.status;
    }

    $('.js-transaksi_konsumen_id').text(dataTransaksi.transaksi_konsumen_id);
    $('.js-nama_konsumen').text(dataTransaksi.nama_konsumen);
    $('.js-alamat').text(dataTransaksi.alamat);
    $('.js-catatan_order').text(dataTransaksi.catatan_order);
    $('.js-jenis_order').text($helper.humanize(dataTransaksi.jenis_order));
    $('.js-status').text($helper.humanize(statusText));
    $('.js-total_biaya').text(dataTransaksi.total_biaya);
    $('.js-tanggal_transaksi').text(dataTransaksi.tanggal_transaksi);
    $('.js-bukti-pembayaran').html(_btnBuktiTransfer(dataTransaksi.bukti_transfer));

    _populateStatusDropdown(_dropDownStatus(dataTransaksi.jenis_order), dataTransaksi.status);

    $('.js-field-nomor-resi').hide();

    $('#js-form-aksi').on('change', '#js-status-pesanan', function() {
      if ($('#js-status-pesanan').val() == 'diantar') {
        $('.js-field-nomor-resi').show();
      } else {
        $('.js-field-nomor-resi').hide();
      }
    });

    $('#js-konfirmasi-transaksi').modal('show');
  }

  const aksiTransaksi = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-form-aksi'));

    let payload = {
      data: formData,
      id: _idTransaksiKonsumen,
    }

    $swal({
        title: "Anda yakin?",
        text: `Transaksi dengan ID ${_idTransaksiKonsumen} akan dikonfirmasi!`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willConfirm) => {
        if (willConfirm) {
          transaksiStore.setStatusAction(payload)
            .then(res => {
              if (res.status == 200) {
                getTransaksi();
                $helper.resetForm($('#js-form-aksi'));
              }
            });
        } else {
          $swal("Transaksi Batal Dikonfirmasi!");
        }
      });
  }

  const aksiVerifikasi = (idTransaksi) => {
    let payload = {
      data: {
        aksi: 'terverifikasi'
      },
      id: idTransaksi,
    }

    $swal({
        title: "Anda yakin?",
        text: `Transaksi dengan ID ${idTransaksi} akan diverifikasi!`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willConfirm) => {
        if (willConfirm) {
          transaksiStore.setStatusAction(payload)
            .then(res => {
              if (res.status == 200) {
                getTransaksi();
              }
            });
        } else {
          $swal("Transaksi Batal Diverifikasi!");
        }
      });
  }

  const _populateStatusDropdown = (statuses, currentStatus) => {
    let $dropdown = $('#js-status-pesanan');
    $dropdown.empty();
    $dropdown.append($("<option />").val("").text("Pilih Status"));

    for (const item of statuses) {
      if (item == currentStatus) {
        continue;
      }

      $dropdown.append($("<option />").val(item).text($helper.humanize(item)));
    }
  }

  const _btnBuktiTransfer = (buktiTransfer) => {
    if (buktiTransfer == null || buktiTransfer == '') {
      return 'Bukti Belum Ada'
    }

    return `<button type="button" class="btn btn-sm btn-primary"
          onclick="modalBuktiTransfer('${buktiTransfer}')">
          Lihat Bukti Transfer</button>`
  }

  const _dropDownStatus = (jenis) => {
    /**
     * 'belum_bayar',
     * 'menunggu_verifikasi',
     * 'terverifikasi',
     * 'diantar',
     * 'siap diambil',
     * 'selesai',
     * 'dibatalkan'
     */
    switch (jenis) {
      case 'take_away':
        return [
          'siap diambil',
          'selesai',
          'dibatalkan',
        ];
      case 'delivery':
        return [
          'diantar',
          'selesai',
          'dibatalkan',
        ];
    }
  }
</script>
@endsection