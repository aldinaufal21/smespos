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
  $.each(__formObject.serializeArray(), function() {
      result[this.name] = this.value;
  });

  return result;
}

exports.showAxiosError = (err) => {
  $swal({
    icon: 'error',
    title: 'Oops...',
    text: (err.response)?err.response.statusText:'Terjadi Kesalahan!',
  })
}
