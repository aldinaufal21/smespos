exports.allEmployee = () => {
  return axios.get('/employees')
}

exports.getEmployee = (umkmId = null, cabangId = null) => {
  let condition = '';

  if (cabangId || umkmId) {
    condition += '?';
  }

  if (cabangId) {
    condition += `cabang_id=${cabangId}&`;
  }

  if (umkmId) {
    condition += `umkm_id=${umkmId}&`;
  }
  
  return axios.get(`/employees/all/${condition}`)
}

exports.addEmployee = ({ data }) => {
  return axios.post('/employees', data)
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

exports.updateEmployee = ({ data, id }) => {
  return axios.post(`/employees/${id}`, data)
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

exports.destroyEmployee = (id) => {
  return axios.delete(`/employees/${id}`)
}

exports.detailEmployee = (id) => {
  return axios.get(`/employees/${id}/detail`)
}
