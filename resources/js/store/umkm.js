exports.allUmkm = () => {
  return axios.get('/umkm-registration')
}

exports.pendingUmkm = () => {
  return axios.get('/umkm-registration?q=pending')
}

exports.approvedUmkm = () => {
  return axios.get('/umkm-registration/?q=approved')
}

exports.addUmkm = ({ data }) => {
  return axios.post('/umkm-registration', data)
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

exports.approveUmkm = (id) => {
  return axios.post(`/umkm/approve`, {
    "umkm_id": id
  })
}

exports.detailUmkm = (id) => {
  return axios.get(`/umkm/profile/${id}`)
}
