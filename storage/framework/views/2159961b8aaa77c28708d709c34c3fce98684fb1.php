<!DOCTYPE html>
<html lang="en">

<head>

  <title><?php echo e(config('app.name')); ?> - <?php echo $__env->yieldContent('title', ''); ?></title>

  <?php echo $__env->make('layouts.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldContent('extra_head'); ?>

  <style media="screen">
    .nav-pemilik,
    .nav-cabang,
    .nav-kasir,
    .nav-pengelola {
      display: none;
    }
  </style>
</head>

<body id="page-top">

  <div id="wrapper">

    <?php echo $__env->make('layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php echo $__env->make('layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

      </div>
      <!-- End of Main Content -->

      <?php echo $__env->make('layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
    <!-- End of Content Wrapper -->

  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo e(route('login')); ?>" onclick="logoutOperation()">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <?php echo $__env->make('layouts.partials.footer-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script>
    $auth.needAuthentication();

    let $_user = $auth.userCredentials();

    $('.nav-cabang, .nav-pemilik, .nav-pengelola, .nav-umkm, .nav-kasir').hide();
    switch ($_user.user.role) {
      case 'kasir':
        $('.nav-kasir').show();
        break;
      case 'pemilik':
        $('.nav-pemilik').show();
        break;
      case 'cabang':
        $('.nav-cabang').show();
        break;
      case 'pengelola':
        $('.nav-pengelola').show();
        break;
      case 'umkm':
        $('.nav-umkm').show();
        break;
    }

    $('#js-usersname-display').text($_user.user.username);

    const logoutOperation = () => {
      // localStorage.clear();
      localStorage.removeItem('user');
      window.location.href = $baseURL + '/login';
    }
  </script>

  <?php echo $__env->yieldContent('extra_script'); ?>

</body>

</html>
<?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/layouts/app.blade.php ENDPATH**/ ?>