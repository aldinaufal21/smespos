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

exports.dateFormat = (date) => {
  var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2)
    month = '0' + month;
  if (day.length < 2)
    day = '0' + day;

  return [year, month, day].join('-');
}

exports.yearMonthDateFormat = (date) => {
  var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    year = d.getFullYear();

  if (month.length < 2)
    month = '0' + month;

  return [year, month].join('-');
}
