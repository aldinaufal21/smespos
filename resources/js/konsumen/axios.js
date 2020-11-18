import axios_ from 'axios';

const token = localStorage.getItem('token');

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

if (token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export default axios
