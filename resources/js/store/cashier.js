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

exports.openCashier = (data) => {
  return axios.post(`/bukaKasir`, data)
    .then((res) => {
      let user = JSON.parse(localStorage.getItem('user'));
      if (!user) throw 'User data not found';
      if (!user.kasir) throw 'Kasir data not found';

      user.kasir.status_kasir = 'buka';
      user.sesi_kasir = res.data;
      localStorage.setItem("user", JSON.stringify(user));

      window.location.href = $baseURL + '/kasir/transaksi';
      return res;
    })
    .catch((err) => {
      console.log(err);
      $helper.showAxiosError(err);
    })
}

exports.closeCashier = (data) => {
  return axios.post(`/tutupKasir`, data)
    .then((res) => {
      let user = JSON.parse(localStorage.getItem('user'));
      if (!user){throw 'User data not found';}
      if (!user.kasir){throw 'Kasir data not found';}

      user.kasir.status_kasir = 'tutup';
      delete user.sesi_kasir;
      localStorage.setItem("user", JSON.stringify(user));

      window.location.href = $baseURL + '/kasir';
      return res;
    })
    .catch((err) => {
      console.log(err);
      $helper.showAxiosError(err);
    })
}
