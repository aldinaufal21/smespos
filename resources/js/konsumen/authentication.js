/**
 * file for authentication checker
 */

exports.needAuthentication = () => {
  const token = localStorage.getItem('token');
  if (!token) {
    window.location.href = $baseURL + '/login';
  }
}

exports.isAuthenticated = () => {
  const token = localStorage.getItem('token');
  if (token) {
    return true;
  }

  return false;
}

exports.authenticated = () => {
  const token = localStorage.getItem('token');
  if (token) {
    window.location.href = $baseURL + '/  ';
  }
}

exports.token = () => {
  return localStorage.getItem('token');
}
