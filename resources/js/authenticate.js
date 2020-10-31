/**
 * file for authentication checker
 */

window.needAuthentication = () => {
  const user = JSON.parse(localStorage.getItem('user'));
  if (!user || !user.token) {
    window.location.href = '/login';
  }
}

window.authenticated = () => {
  const user = JSON.parse(localStorage.getItem('user'));
  if (user && user.token) {
    window.location.href = '/dashboard';
  }
}

window.userCredentials = () => {
  return JSON.parse(localStorage.getItem('user'));
}
