exports.allProduct = () => {
  return axios.get('/product')
}

exports.UmkmsProduct = (idUmkm) => {
  return axios.get(`/product?id_umkm=${idUmkm}`)
}

exports.detailProduk = (id) => {
  return axios.get(`/product/${id}`)
}
