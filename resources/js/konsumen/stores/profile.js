exports.getProfile = () => {
  return axios.get('consumer/profile')
          .catch((err)=>{
            console.log(err);
          })
}

// exports.updateCart = ({ data, id }) => {
//   return axios.patch(`/cart/${id}`, data)
//     .then((res) => {
//       return res;
//     })
//     .catch((err) => {
//       console.log(err);
//     })
// }
