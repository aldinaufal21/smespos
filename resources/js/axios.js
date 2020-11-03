const axios_ = require('axios');

const user = JSON.parse(localStorage.getItem('user'));

let axios = axios_.create({
  baseURL: process.env.MIX_APP_ROOT_API,
  // You can add your headers here
  headers: {
    'Content-Type': 'application/json',
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Methods': 'GET, POST, PUT, PATCH, DELETE, OPTIONS, HEAD',
    'Access-Control-Allow-Headers': 'Access-Control-Allow-Headers, Access-Control-Allow-Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers',
  },
  xsrfCookieName: "csrftoken",
  xsrfHeaderName: "X-CSRFTOKEN",
})

if (user && user.token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${user.token}`;
}

export default axios
