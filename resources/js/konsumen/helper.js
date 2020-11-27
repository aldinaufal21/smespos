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

exports.humanize = (underscoredString) => {
  var i, frags = underscoredString.split('_');
  for (i = 0; i < frags.length; i++) {
    frags[i] = frags[i].charAt(0).toUpperCase() + frags[i].slice(1);
  }
  return frags.join(' ');
}

exports.errorModal = (err = null) => {

  if (err == null) {
    $swal({
      icon: 'error',
      title: 'Oops...',
      text: 'Terjadi Kesalahan!',
    });

    return;
  }

  let response = err.response;

  if (response.status == 500) {
    $swal({
      icon: 'error',
      title: 'Oops...',
      text: 'Terjadi Kesalahan!',
    });

    return;
  }

  let data = response.data;

  if (data.errors) {
    const errorData = data.errors;
    const list = document.createElement('ul');

    for (let [key, value] of Object.entries(errorData)) {
      const listItem = document.createElement('li');

      listItem.innerHTML = `${value}`;
      list.appendChild(listItem);
    }

    $swal({
      icon: 'error',
      title: 'Oops...',
      content: list,
    });
  } else if (data.message) {
    let errorData = data.message;

    // custom message
    if (errorData == 'Unauthenticated.') {
      errorData = "Harap Login terlebih dahulu"
    }

    $swal({
      icon: 'error',
      title: 'Oops...',
      text: errorData,
    });
  }
}
