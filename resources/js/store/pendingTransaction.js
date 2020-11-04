exports.store = (data) => {
  let oldData = JSON.parse(localStorage.getItem('pending_transactions')) || [];
  oldData.push(data);

  localStorage.setItem("pending_transactions", JSON.stringify(oldData));
}

exports.getAll = () => {
  return JSON.parse(localStorage.getItem('pending_transactions')) || [];
}
