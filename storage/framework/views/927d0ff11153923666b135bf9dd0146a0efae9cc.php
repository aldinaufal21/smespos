<?php $__env->startSection('title','Home'); ?>

<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<style media="screen">

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- main wrapper start -->
  <main>
      <!-- breadcrumb area start -->
      <div class="breadcrumb-area common-bg">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="breadcrumb-wrap">
                          <nav aria-label="breadcrumb">
                              <h1>Kontak Kami</h1>
                              <ul class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Contact</li>
                              </ul>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- breadcrumb area end -->

      <!-- contact area start -->
      <div class="contact-area section-space pb-0">
          <div class="container">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="contact-message">
                          <h2>Hubungi kami</h2>
                          <form method="post" class="contact-form">
                              <?php echo csrf_field(); ?> <!-- <?php echo e(csrf_field()); ?> -->
                              <div class="row">
                                  <div class="col-lg-6 col-md-6 col-sm-6">
                                      <input name="first_name" placeholder="Nama *" type="text" required>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-6">
                                      <input name="phone" placeholder="Nomor telepon *" type="text" required>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-6">
                                      <input name="email_address" placeholder="Email *" type="text" required>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-6">
                                      <input name="contact_subject" placeholder="Subjek *" type="text">
                                  </div>
                                  <div class="col-12">
                                      <div class="contact2-textarea text-center">
                                          <textarea placeholder="Pesan *" name="message" class="form-control2" required=""></textarea>
                                      </div>
                                      <div class="contact-btn">
                                          <button class="btn btn__bg" style="background-color: #FE914A" type="submit">Kirim Pesan</button>
                                      </div>
                                  </div>
                                  <div class="col-12 d-flex justify-content-center">
                                      <p class="form-messege"></p>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="contact-info">
                          <h2>Kontak Kami</h2>
                          <p>Koral Roket Retail</p>
                          <ul>
                              <li><i class="fa fa-fax"></i> Jl. Telekomunikasi No. 1, Terusan Buahbatu - Bojongsoang, Sukapura, Kec. Dayeuhkolot, Bandung, Jawa Barat 40257</li>
                              <li><i class="fa fa-phone"></i> (012) 800 456 789-987</li>
                              <li><i class="fa fa-envelope-o"></i> admin@smespos.id</li>
                          </ul>
                          <div class="working-time">
                              <h3>Jam Kerja</h3>
                              <p><span>Senin - Sabtu :</span>08.00 – 17.00</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- contact area end -->
  </main>
  <!-- main wrapper end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_script'); ?>
<!-- Page level plugins -->
<script>

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('konsumen_app.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/fit-iduka.com/ptviduka_pos/resources/views/konsumen_app/contact_us.blade.php ENDPATH**/ ?>