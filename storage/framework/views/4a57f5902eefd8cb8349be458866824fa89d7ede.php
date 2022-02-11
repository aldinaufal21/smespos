<!DOCTYPE html>
<html lang="en">

<head>

  <title>SMEs POS - <?php echo $__env->yieldContent('title', ''); ?></title>

  <?php echo $__env->make('konsumen_app.layouts.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->yieldContent('extra_head'); ?>
</head>

<body>
  <?php echo $__env->make('konsumen_app.layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->make('konsumen_app.layouts.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('content'); ?>

  <?php echo $__env->make('konsumen_app.layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- offcanvas search form start -->
  <div class="offcanvas-search-wrapper">
      <div class="offcanvas-search-inner">
          <div class="offcanvas-close">
              <i class="lnr lnr-cross"></i>
          </div>
          <div class="container">
              <div class="offcanvas-search-box">
                  <form class="d-flex bdr-bottom w-100">
                      <input type="text" placeholder="Search entire storage here...">
                      <button class="search-btn"><i class="lnr lnr-magnifier"></i>search</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- offcanvas search form end -->

  <!-- Scroll to top start -->
  <div class="scroll-top not-visible">
      <i class="fa fa-angle-up"></i>
  </div>
  <!-- Scroll to Top End -->

  <?php echo $__env->make('konsumen_app.layouts.partials.footer-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->make('konsumen_app.layouts.partials.mini-cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <script type="text/javascript">
      let _token = localStorage.getItem('token');

      // header conditions
      if (_token) {
        $('.js-authenticated-user').show();
      }else {
        $('.js-non-authenticated-user').show();
      }

      function logoutAction() {
        $swal({
            title: "Anda yakin ingin keluar?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((doLogout) => {
            if (doLogout) {
              localStorage.removeItem('token');
              window.location.href = $baseURL + '/login';
            }
          });
      }
  </script>

  <?php echo $__env->yieldContent('extra_script'); ?>

</body>

</html>
<?php /**PATH /Users/izharauliataqwa/Documents/project/idukafix/resources/views/konsumen_app/layouts/app.blade.php ENDPATH**/ ?>