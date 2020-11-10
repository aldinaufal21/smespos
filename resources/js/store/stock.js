exports.allStock = (productId = null, beforeDate = null, afterDate = null) => {
  let condition = '';

  // ?produk_id=1&sebelum_tanggal=2020-10-30 03:02:25.0&sesudah_tanggal=2020-10-30 03:02:24.0
  if (productId || beforeDate || afterDate) {
    condition += '?';
  }

  if (productId) {
    condition += `produk_id=${productId}&`;
  }

  if (beforeDate) {
    condition += `sebelum_tanggal=${productId}&`;
  }
  
  if (afterDate) {
    condition += `sesudah_tanggal=${productId}`;
  }

  return axios.get(`/stock/${condition}`);
}

exports.addStock = ({ data }) => {
  return axios.post(`/stock`, data)
    .then((res) => {
      $swal({
        icon: 'success',
        title: 'Data Input',
        text: 'Data Stok berhasil di-input!',
      })
      return res;
    })
    .catch((err) => {
      $ui.errorModal(err);
    })
}

exports.updateStock = ({ data, id }) => {
  return axios.put(`/stock/${id}`, data)
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

exports.stockDetail = (id) => {
  return axios.get(`/stock/${id}`)
}
