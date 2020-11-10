exports.konsumen = ({ data }) => {
  axios.post('/consumer/register',
    data,
  )
    .then(function (res) {
      $swal({
        icon: 'success',
        title: 'Registrasi',
        text: 'Registrasi Berhasil!',
        buttons: {
          confirm: true,
        },
      }).then((res) => {
        window.location.href = '/login';
      });
  
      setTimeout(() => {
        $swal.close();
      }, 3000);

      return res;
    })
    .catch(function (error) {
      $ui.errorModal(error);
    });
}

exports.umkm = ({ data }) => {
  axios.post('/umkm/register',
    data,
  )
    .then(function (res) {
      $swal({
        icon: 'success',
        title: 'Registrasi',
        text: 'Registrasi Berhasil!',
        buttons: {
          confirm: true,
        },
      }).then((res) => {
        window.location.href = '/login';
      });
  
      setTimeout(() => {
        $swal.close();
      }, 3000);

      return res;
    })
    .catch(function (error) {
      $ui.errorModal(error);
    });
}
