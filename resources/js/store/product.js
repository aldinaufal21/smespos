exports.allProduct = () => {
  return axios.get('/product')
}

exports.addProduct = ({ data }) => {
  return axios.post('/product', data)
    .then((res) => {
      $swal({
        icon: 'success',
        title: 'Data Input',
        text: 'Data berhasil di-input!',
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

exports.updateProduct = ({ data, id }) => {
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

exports.destroyProduct = (id) => {
  return axios.delete(`/product/${id}`)
}

exports.UmkmsProduct = (idUmkm) => {
  return axios.get(`/product?id_umkm=${idUmkm}`)
}

exports.detailProduk = (id) => {
  return axios.get(`/product/${id}`)
}
