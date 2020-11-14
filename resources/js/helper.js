/**
 *
 *
 */

/**
 *
 * @param {*} __formObject
 *
 * @return JSON
 */
exports.serializeObject = (formObject) => {
  let __formObject = formObject;

  let result = {};
  $.each(__formObject.serializeArray(), function () {
    result[this.name] = this.value;
  });

  return result;
}

exports.showAxiosError = (err) => {
  $swal({
    icon: 'error',
    title: 'Oops...',
    text: (err.response) ? err.response.statusText : 'Terjadi Kesalahan!',
  })
}

exports.rupiahFormat = (value) => {
  return (value / 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

exports.resetForm = (form) => {
  form.each(function () {
    this.reset();
  });

  form.closest('.modal').modal('hide');
}
