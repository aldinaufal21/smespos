exports.allCategory = () => {
  return axios.get('/category')
}

exports.addCategory = ({ data }) => {
  return axios.post('/category', data)
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

exports.updateCategory = ({ data, id }) => {
  return axios.patch(`/category/${id}`, data)
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

exports.destroyCategory = (id) => {
  return axios.delete(`/category/${id}`)
}

exports.UmkmsCategory = (idUmkm) => {
  return axios.get(`/category/?id_umkm=${idUmkm}`)
}

exports.categoryDetail = (id) => {
  return axios.get(`/category/${id}`)
}
