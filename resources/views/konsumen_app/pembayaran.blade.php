@extends('konsumen_app.layouts.app')

@section('title','Checkout')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
  <!-- main wrapper start -->
  <main id="vue-pembayaran">

      <!-- checkout main wrapper start -->
      <div class="checkout-page-wrapper section-space pb-0">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <!-- Checkout Login Coupon Accordion Start -->
                      <div class="checkoutaccordion" id="checkOutAccordion">

                          <div class="card">
                              <h3 data-toggle="collapse" data-target="#couponaccordion">Petunjuk pembayaran</h3>
                              <div id="couponaccordion" class="collapse show" data-parent="#checkOutAccordion">
                                  <div class="card-body">
                                      <div class="row">
                                        <div class="col-md-3">
                                          <img src="http://localhost:8000/images/image_dummy.png" alt="">
                                          <center>
                                            <h4>BRI</h4>
                                            <p>a/n Rudi Santoso</p>
                                            <p>12345456</p>
                                          </center>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Checkout Login Coupon Accordion End -->
                  </div>
                  <div class="col-12">
                      <!-- Checkout Login Coupon Accordion Start -->
                      <div class="checkoutaccordion" id="buktiBayar">

                          <div class="card">
                              <h3 data-toggle="collapse" data-target="#couponaccordion">Upload bukti pembayaran anda</h3>
                              <div id="couponaccordion" class="collapse show" data-parent="#buktiBayar">
                                  <div class="card-body">
                                    <form class="" action="index.html" method="post">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="single-input-item">
                                              <label for="fullname" class="required">Nama Pengiriman</label>
                                              <input type="text" id="fullname" placeholder="nama Pengirim" required/>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="single-input-item">
                                              <label for="bank-pengirim" class="required">Bank Pengiriman</label>
                                              <input type="text" id="bank-pengirim" placeholder="Bank Pengirim (BRI/BNI)" required/>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="single-input-item">
                                              <label for="foto-bukti" class="required">Bukti Pembayaran</label>
                                              <input type="file" id="foto-bukti" required/>
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          <br>
                                          <button type="submit" class="btn btn__bg">Upload</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- Checkout Login Coupon Accordion End -->
                  </div>
              </div>
          </div>
      </div>
      <!-- checkout main wrapper end -->
  </main>
  <!-- main wrapper end -->
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>
$auth.needAuthentication();

var pembayaran_vue = new Vue({
  el: '#vue-pembayaran',
  data(){
    return{
      token: null,
      banks: [],
    }
  },
  created() {
    //do something after mounting vue instance
    this.token = localStorage.getItem('token');
  },
  mounted() {
    //do something after mounting vue instance
    // $('select').niceSelect('update');
  },
  methods: {
    getUserDetails() {
      profileStore.getProfile()
                    .then((res)=>{
                      // console.log(res);
                      this.profile_detail = res.data;
                    })
    },

    rupiahFormat(value){
      return $helper.rupiahFormat(value);
    },

  }
})

</script>
@endsection
