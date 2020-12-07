let $__buttonText = "";

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
    const errorData = data.message;

    $swal({
      icon: 'error',
      title: 'Oops...',
      text: errorData,
    });
  }
  
  $ui.toggleButtonLoading(null, false);
}

exports.toggleButtonLoading = (form = null, loadingStatus = true, defaultButtonText = null) => {
  if (form == null) {
    let formSubmitButton = $('form').find('button[type="submit"]');
    formSubmitButton.prop('disabled', false);
    formSubmitButton.text($__buttonText);
    return;
  }

  let submitButton = form.find('button[type="submit"]');
  let html = `
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Memproses...
  `;

  $__buttonText = submitButton.text();
  let setButtonText = defaultButtonText ? defaultButtonText : $__buttonText;

  if (loadingStatus) {
    submitButton.prop('disabled', true);
    submitButton.html(html);
  } else {
    submitButton.prop('disabled', false);
    submitButton.text(setButtonText);
  }
  return;
}
