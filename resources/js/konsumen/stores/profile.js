exports.getProfile = () => {
  return axios.get('consumer/profile')
    .catch((err) => {
      console.log(err);
    })
}

exports.updateProfile = ({ data }) => {
  return axios.post('consumer/profile/edit', data)
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

exports.updatePassword = ({ data }) => {
  return axios.patch('auth/reset_password', data)
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

// exports.updateCart = ({ data, id }) => {
//   return axios.patch(`/cart/${id}`, data)
//     .then((res) => {
//       return res;
//     })
//     .catch((err) => {
//       console.log(err);
//     })
// }
