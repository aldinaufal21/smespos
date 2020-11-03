exports.allStock = () => {
  return axios.get('/product')
}

exports.addStock = ({ data, id }) => {
  return axios.post(`/stock/${id}`, data)
    .then((res) => {
      $swal({
        icon: 'success',
        title: 'Data Input',
        text: 'Data Stok berhasil di-input!',
      })
      return res;
    })
    .catch((err) => {
      console.log(err.response);
      
      $swal({
        icon: 'error',
        title: 'Oops...',
        text: 'Terjadi Kesalahan!',
      })
    })
}

exports.updateStock = ({ data, id }) => {
  return axios.post(`/product/${id}`, data)
    .then((res) => {
      $swal({
        icon: 'success',
        title: 'Data Update',
        text: 'Data berhasil di-update!',
      })
      return res;
    })
    .catch((err) => {
      console.log(err.response);
      
      $swal({
        icon: 'error',
        title: 'Oops...',
        text: 'Terjadi Kesalahan!',
      })
    })
}

exports.destroyStock = (id) => {
  return axios.delete(`/product/${id}`)
}

exports.UmkmsStock = (idUmkm) => {
  return axios.get(`/product?id_umkm=${idUmkm}`)
}

exports.productDetail = (id) => {
  return axios.get(`/product/${id}`)
}
