@extends('layouts.app')

@section('extra_head')
<!-- Custom styles for this page -->
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bank</h1>
  </div>


  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Bank</h6>
    </div>
    <div class="card-body">
      <div class="d-sm-flex align-items-center justify-content-between mb-4 float-right">
        <button class="btn btn-primary" onclick="createBank()">
          <i class="fas fa-plus-circle fa-sm text-white-50"></i> Tambah Bank
        </button>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="js-tabel-bank" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Bank</th>
              <th>Nomor Rekening</th>
              <th>Rekening Atas Nama</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama Bank</th>
              <th>Nomor Rekening</th>
              <th>Rekening Atas Nama</th>
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

<!-- Modal Tambah -->
<div class="modal fade" id="js-bank-modal" tabindex="-1" role="dialog" aria-labelledby="tambahProdukModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahProdukModal">Tambah Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" id="js-bank-form" data-edit="" onsubmit="categoryFormAction(event)">
          <input type="hidden" name="_token" value="">
          <div class="form-group">
            <label class="control-label">Nama Bank</label>
            <div>
              <input type="text" class="form-control input-lg" id="js-nama-bank" name="nama_bank" placeholder="Nama Bank">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Nomor Rekening</label>
            <div>
              <input type="text" class="form-control input-lg" id="js-rekening" name="rekening" placeholder="Nomor Rekening">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">Atas Nama</label>
            <div>
              <input type="text" class="form-control input-lg" id="js-atas-nama" name="atas_nama" placeholder="Atas Nama">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary float-right" id="js-submit-button">
              Tambah
            </button>
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
  let tabelBank = null;
  let user = null;
  let _idBank = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    tabelBank = $("#js-tabel-bank").DataTable();

    getBanks();
  });

  // dummy function for get dummy products data
  // will be deleted on next development

  const getBanks = () => {
    let umkm = user.umkm.umkm_id;

    bankStore.UmkmsBank(umkm).then((res) => {
      banks = res.data;
      populateTable(banks);
    });
  }

  const populateTable = (data) => {
    tabelBank.clear().draw();
    let number = 1;

    data.forEach(item => {
      tabelBank.row.add([
        number,
        item.nama_bank,
        item.rekening,
        item.atas_nama,
        `<button type="button" class="btn btn-sm btn-success" onclick="editBank(${item.bank_id})" data-id="${item.bank_id}">
          <i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-sm btn-danger" onclick="deleteBank(${item.bank_id})" data-id="">
          <i class="fas fa-trash"></i></button>`
      ]).draw();
      number++;
    });
  }

  const categoryFormAction = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-bank-form'));

    let payload = {
      data: formData,
    }

    let formEdit = $('#js-bank-form').attr('data-edit');
    $ui.toggleButtonLoading($('#js-bank-form'));

    if (formEdit) {
      payload.id = _idBank;
      bankStore.updateBank(payload)
        .then(res => {
          if (res.status == 200) {
            getBanks();
            $helper.resetForm($('#js-bank-form'));
            $ui.toggleButtonLoading($('#js-bank-form'), false);
          }
        })
    } else {
      bankStore.addBank(payload)
        .then(res => {
          if (res.status == 201) {
            getBanks();
            $helper.resetForm($('#js-bank-form'));
            $ui.toggleButtonLoading($('#js-bank-form'), false);
          }
        })
    }
  }

  const createBank = () => {
    $helper.resetForm($('#js-bank-form'));
    $('#js-bank-form').attr('data-edit', '');
    $('#js-submit-button').text('Tambah');
    $('#js-bank-modal').modal('show');
  }

  const editBank = (idBank) => {
    _idBank = idBank;
    bankStore.bankDetail(idBank)
      .then(res => {
        data = res.data;

        $('#js-nama-bank').val(data.nama_bank);
        $('#js-rekening').val(data.rekening);
        $('#js-atas-nama').val(data.atas_nama);
        $('#js-bank-form').attr('data-edit', 'true');
        $('#js-submit-button').text('Ubah');

        $('#js-bank-modal').modal('show');
      });
  }

  const deleteBank = (idBank) => {
    bankStore.bankDetail(idBank)
      .then(res => {
        data = res.data;

        $swal({
            title: "Anda yakin?",
            text: `Bank ${data.nama_bank} akan dihapus selamanya!`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              bankStore.destroyBank(idBank)
                .then(res => {
                  $swal("Bank Berhasil Dihapus!", {
                    icon: "success",
                  });
                  getBanks();
                })
                .catch(err => {
                  $swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi Kesalahan!',
                  })
                });
            } else {
              $swal("Bank Batal Dihapus!");
            }
          });
      });
  }
</script>
@endsection