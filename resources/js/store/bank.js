exports.allBank = () => {
  return axios.get('/bank')
}

exports.addBank = ({ data }) => {
  return axios.post('/bank', data)
    .then((res) => {
      $swal({
        icon: 'success',
        title: 'Data Input',
        text: 'Data berhasil di-input!',
      })
      return res;
    })
    .catch((err) => {
      $ui.errorModal(err);
    })
}

exports.updateBank = ({ data, id }) => {
  return axios.patch(`/bank/${id}`, data)
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

exports.destroyBank = (id) => {
  return axios.delete(`/bank/${id}`)
}

exports.UmkmsBank = (idUmkm) => {
  return axios.get(`/bank/?id_umkm=${idUmkm}`)
}

exports.bankDetail = (id) => {
  return axios.get(`/bank/${id}`)
}
