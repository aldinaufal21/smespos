exports.allEmployee = () => {
  return axios.get('/employees')
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
      console.log(err.response);
      
      $swal({
        icon: 'error',
        title: 'Oops...',
        text: 'Terjadi Kesalahan!',
      })
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
      console.log(err.response);
      
      $swal({
        icon: 'error',
        title: 'Oops...',
        text: 'Terjadi Kesalahan!',
      })
    })
}

exports.destroyEmployee = (id) => {
  return axios.delete(`/employees/${id}`)
}

exports.detailEmployee = (id) => {
  return axios.get(`/employees/${id}`)
}
