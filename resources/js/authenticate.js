/**
 * file for authentication checker
 */

exports.needAuthentication = () => {
  const user = JSON.parse(localStorage.getItem('user'));
  if (!user || !user.token) {
    window.location.href = '/login';
  }
}

exports.authenticated = () => {
  const user = JSON.parse(localStorage.getItem('user'));
  if (user && user.token) {
    window.location.href = '/dashboard';
  }
}

exports.userCredentials = () => {
  return JSON.parse(localStorage.getItem('user'));
}
