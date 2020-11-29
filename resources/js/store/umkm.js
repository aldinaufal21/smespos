exports.allUmkm = () => {
  return axios.get('/umkm-registration')
}

exports.pendingUmkm = () => {
  return axios.get('/umkm-registration?q=pending')
}

exports.approvedUmkm = () => {
  return axios.get('/umkm-registration/?q=approved')
}

exports.allUmkmDetails = (umkmId) => {
  let condition = '';

  if (umkmId) {
    condition = `?umkm_id=${umkmId}`;
  }

  return axios.get(`/umkm/${condition}`)
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
      $ui.errorModal(err);
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

exports.updateUmkm = ({ data }) => {
  return axios.post('/umkm/profile/edit/', data)
    .then((res) => {
      $swal({
        icon: 'success',
        title: 'Ubah Data',
        text: 'Data berhasil di-ubah!',
      })
      return res;
    })
    .catch((err) => {
      $ui.errorModal(err);
    })
}
