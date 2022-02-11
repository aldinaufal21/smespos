<?php $__env->startSection('extra_script'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/izharauliataqwa/Documents/project/idukafix/resources/views/dashboard.blade.php ENDPATH**/ ?>