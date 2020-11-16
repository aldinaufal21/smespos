exports.getTransaksi = (
  idKonsumen = null, 
  idTransaksi = null, 
  jenisOrder = null, 
  status = null, 
  adaBuktiTransfer = null, 
  noResi = null
) => {
  
  let condition = '';

  if (idKonsumen || 
    idTransaksi || 
    jenisOrder || 
    status || 
    adaBuktiTransfer || 
    noResi) {
    condition += '?';
  }

  if (idKonsumen) {
    condition += `id_konsumen=${idKonsumen}&`;
  }

  if (idTransaksi) {
    condition += `id_transaksi=${idTransaksi}&`;
  }
  
  if (jenisOrder) {
    condition += `jenis_order=${jenisOrder}&`;
  }

  if (status) {
    condition += `status=${status}&`;
  }

  if (adaBuktiTransfer) {
    condition += `ada_bukti_transfer=${adaBuktiTransfer}&`;
  }
  
  if (noResi) {
    condition += `no_resi=${noResi}`;
  }

  return axios.get(`/getTransaksiKonsumen/${condition}`)
}

exports.setStatusAction = ({ data, id }) => {
  return axios.patch(`/setTransaksiAction/${id}`, data)
    .then((res) => {
      $swal({
        icon: 'success',
        title: 'Data Update',
        text: 'Data berhasil di-update!',
      })
      return res;
    })
    .catch((err) => {
      $ui.errorModal(err);
    })
}

exports.getDetailTransaksi = (idTransaksi) => {
  return axios.get(`/getTransaksiKonsumen/?id_transaksi=${idTransaksi}`)
}
