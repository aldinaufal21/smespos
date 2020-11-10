exports.allBranch = () => {
  return axios.get('/branches')
}

exports.addBranch = ({ data }) => {
  return axios.post('/branches', data)
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

exports.updateBranch = ({ data, id }) => {
  return axios.post(`/branches/${id}`, data)
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

exports.destroyBranch = (id) => {
  return axios.delete(`/branches/${id}`)
}

exports.detailBranch = (id) => {
  return axios.get(`/branches/${id}`)
}
