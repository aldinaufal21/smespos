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

/**
 * @param {Array} roles The array of role
 * @param {string} roles The string
 * roles can be array of role, or string of 1 role
 */
exports.needRole = (roles) => {
  const user = JSON.parse(localStorage.getItem('user'));
  if (Array.isArray(roles)) {
    if (!roles.includes(user.user.role)) {
      $swal({
        'title': 'Forbidden!!'
      }).then((ok)=>{
        if (ok) {
          window.location.href = '/dashboard';
        }
      })
    }
  }else {
    if (user.user.role != roles) {
      console.log("tes");
      $swal({
        'title': 'Forbidden!!'
      }).then((ok)=>{
        if (ok) {
          window.location.href = '/dashboard';
        }
      })
    }
  }
}
