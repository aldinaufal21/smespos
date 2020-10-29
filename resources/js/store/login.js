exports.doLogin = ({ data }) => {
  axios.post('/login',
    data,
  )
    .then(function (response) {
      data = response.data

      localStorage.setItem("user", JSON.stringify(data));
    })
    .catch(function (error) {
      console.log(error);
    });
}
