@extends('layouts.app')

@section('extra_script')
<!-- Page level plugins -->
<script type="text/javascript">
  $auth.needAuthentication();
  let user = $auth.userCredentials();
  let role = user.user.role;
  if (role=='umkm') {
    window.location.href = $baseURL + '/dashboard-umkm';
  }else if (role=='cabang') {
    window.location.href = $baseURL + '/dashboard-cabang';
  }else if (role=='kasir') {
    window.location.href = $baseURL + '/kasir';
  }else if (role=='pengelola') {
    window.location.href = $baseURL + '/dashboard-pengelola';
  }
</script>
@endsection
