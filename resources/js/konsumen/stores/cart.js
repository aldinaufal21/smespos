exports.getCart = () => {
  return axios.get('/cart')
              .catch((err)=>{
                console.log(err);
                $helper.errorModal(err);
              });
}

exports.addCart = (payload) => {
  return axios.post('/cart', payload).then((res)=>{
          if (res.status == 201 || res.status == 200) {
            swal({
              icon: "success",
              title: "Produk berhasil dimasukkan ke keranjang"
            });
          }
        }).catch((err)=>{
          console.log(err);
          $helper.errorModal(err);
        });
}

exports.updateCart = ({ data, id }) => {
  return axios.patch(`/cart/${id}`, data)
    .then((res) => {
      return res;
    })
    .catch((err) => {
      console.log(err);
      $helper.errorModal(err);
    })
}

exports.destroyCart = (produk_id) => {
  return axios.delete(`/cart/${produk_id}`)
              .catch((err)=>{
                console.log(err);
                $helper.errorModal(err);
              });
}

exports.storeCheckoutData = (data) => {
    data = JSON.stringify(data);
    localStorage.setItem('checkout-data', data);
}
