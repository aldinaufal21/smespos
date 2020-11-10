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
}