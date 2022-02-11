<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengaturan Akun</h1>
  </div>

  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Pengaturan Akun</h6>
        </div>
        <div class="card-body">
          <form role="form" id="js-user-form" onsubmit="userFormAction(event)">
            <div class="form-group">
              <label class="control-label">Password Saat Ini</label>
              <div>
                <input type="password" class="form-control input-lg" name="existing_password" id="js-existing-password" placeholder="Password Saat Ini">
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label">Username</label>
              <div>
                <input type="text" class="form-control input-lg" name="username" id="js-username-user" placeholder="Username Baru" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Password Baru</label>
              <div>
                <input type="password" class="form-control input-lg" name="new_password" id="js-password-user" placeholder="Password Baru">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Konfirmasi Password</label>
              <div>
                <input type="password" class="form-control input-lg" name="new_password_confirmation" id="js-password-confirm-user" placeholder="Konfirmasi Password">
              </div>
            </div>
            <div class="form-group">
              <button type="submit" id="js-submit-button" class="btn btn-primary float-right">Ubah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_script'); ?>
<!-- Page level plugins -->
<script src="<?php echo e(asset('vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<script>
  let user = null;

  $(document).ready(() => {
    user = $auth.userCredentials(); // get user credentials
    $('#js-username-user').val(user.user.username);
  });

  const userFormAction = (e) => {
    e.preventDefault();

    let formData = $helper.serializeObject($('#js-user-form'));
    $ui.toggleButtonLoading($('#js-user-form'));

    let payload = {
      data: formData,
    }

    userStore.selfAccountSetting(payload)
      .then(res => {
        if (res.status == 200) {
          $helper.resetForm($('#js-user-form'));
          $ui.toggleButtonLoading($('#js-user-form'), false);
        }
      })
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/user/account_settings.blade.php ENDPATH**/ ?>