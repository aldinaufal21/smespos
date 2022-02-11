<?php $__env->startSection('title', 'Demo'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col">
      <div class="card shadow mb-4">
        <!-- Card Body -->
        <div class="card-body">
          Selamat Datang, <span class="js-username"></span>!
        </div>
      </div>
    </div>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_script'); ?>
<script>
  $(document).ready(() => {
    let user = $auth.userCredentials();
    if (user.user) {
      $('.js-username').text(user.user.username);
    } else {
      $('.js-username').text('Pengguna');
    }
  })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/demo.blade.php ENDPATH**/ ?>