exports.allCashier = () => {
  return axios.get('/cashier')
}

exports.addCashier = ({ data }) => {
  return axios.post('/cashier', data)
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

exports.updateCashier = ({ data, id }) => {
  return axios.patch(`/cashier/${id}`, data)
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

exports.destroyCashier = (id) => {
  return axios.delete(`/cashier/${id}`)
}

exports.detailCashier = (id) => {
  return axios.get(`/cashier/${id}`)
}
