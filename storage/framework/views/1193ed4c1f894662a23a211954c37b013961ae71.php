<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>POS Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>" rel="stylesheet">

  <?php echo $__env->yieldContent('extra_head'); ?>

</head>

<body class="bg-gradient" style="background-color: #FE914A;">

  <?php echo $__env->yieldContent('content'); ?>

  <!-- Call Main JS -->
  <script src="<?php echo e(asset('js/admin.js')); ?>"></script>

  <script>
    $auth.authenticated();
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>

  <?php echo $__env->yieldContent('extra_script'); ?>

</body>

</html>
<?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views////layouts/auth.blade.php ENDPATH**/ ?>