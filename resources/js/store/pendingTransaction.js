// function to make sure stored pending_transactions only one user
const checkUser = () => {
  let data = JSON.parse(localStorage.getItem('pending_transactions')) || [];
  let user = JSON.parse(localStorage.getItem('user'));

  if (data.length && user) {
      if (data[0].username != user.user.username) {
          localStorage.removeItem("pending_transactions");
      }
  }
}

exports.store = (data) => {
  checkUser();
  let oldData = JSON.parse(localStorage.getItem('pending_transactions')) || [];
  oldData.push(data);

  localStorage.setItem("pending_transactions", JSON.stringify(oldData));
}

exports.getAll = () => {
  checkUser();
  return JSON.parse(localStorage.getItem('pending_transactions')) || [];
}

exports.getItem = (id) => {
  let data = JSON.parse(localStorage.getItem('pending_transactions')) || [];
  const index = data.findIndex(item => item.pending_id == id);

  if (index != -1) {
    return data[index];
  }

  return [];
}

exports.removeAll = () => {
  localStorage.removeItem("pending_transactions");
}

exports.remove = (id) => {
  let data = JSON.parse(localStorage.getItem('pending_transactions')) || [];

  if (data.length) {
      let index = data.findIndex(item => item.pending_id == id);
      if (index != -1) {
        data.splice(index, 1);
        localStorage.setItem("pending_transactions", JSON.stringify(data));
      }
  }
}

exports.isValidId = (id) => {
  let data = JSON.parse(localStorage.getItem('pending_transactions')) || [];
  let index = data.findIndex(item => item.pending_id == id);
  return index != -1;
}
