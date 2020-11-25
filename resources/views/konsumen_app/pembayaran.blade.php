@extends('konsumen_app.layouts.app')

@section('title','Pembayaran')

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
                                      <h4>Pilih salah satu pembayaran dibawah, dan upload bukti pembayaran and pada form dibawah</h4>
                                      <br>
                                      <div class="row">
                                        <div class="col-md-3" v-for="item in banks" :key="item.bank_id">
                                          <img src="http://localhost:8000/images/image_dummy.png" alt="" style="margin-bottom:10px;">
                                          <center>
                                            <h4>@{{ item.nama_bank }}</h4>
                                            <p>a/n <b>@{{ item.atas_nama }}</b></p>
                                            <p>No Rekening: <b>@{{ item.rekening }}</b></p>
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
                                    <form @submit="submit($event)">
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="single-input-item">
                                              <label for="fullname" class="required">Nama Pengiriman</label>
                                              <input type="text" id="fullname" placeholder="nama Pengirim" required/>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="single-input-item">
                                              <label for="bank-pengirim" class="required">Pembayaran yg dipilih</label>
                                              <select class="form-control" v-model="selected_bank">
                                                <option value="" selected disabled>--Pilih--</option>
                                                <option :value="item.bank_id" v-for="item in banks" :key="item.bank_id">@{{ item.nama_bank }}</option>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="single-input-item">
                                              <label for="foto-bukti" class="required">Bukti Pembayaran</label>
                                              <input type="file" id="foto-bukti" required @change="handleFileUpload($event)"/>
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
      profile_detail: null,
      transaction_data: null,
      file: '',
      selected_bank: null
    }
  },
  created() {
    //do something after mounting vue instance
    this.token = localStorage.getItem('token');
    this.checkTransactionStatus();
  },
  mounted() {
    //do something after mounting vue instance
    // $('select').niceSelect('update');
    this.getUserDetails();
  },
  methods: {
    getUserDetails() {
      profileStore.getProfile()
                    .then((res)=>{
                      console.log(res);
                      this.profile_detail = res.data;
                    })
    },

    getBanks(){
      axios.get('bank', {cabang_id: this.transaction_data.cabang_id}).then((res) => {
        console.log(res);
        this.banks = res.data;
      }).catch((err)=>{
        console.log(err);
      })
    },

    submit(event){
        event.preventDefault();

        let formData = new FormData();
        formData.append('bukti_transfer', this.file);
        formData.append('transaksi_konsumen_id', this.transaction_data.transaksi_konsumen_id);
        formData.append('bank_id', this.selected_bank);

        console.log(formData);

        axios.post('makePayment', formData).then((res) => {
          console.log(res);
          if (res.status == 200) {
            swal({
              icon: "success",
              title: "Pembayaran akan diperiksa oleh UMKM terkait, tunggu pemberitahuan berikutnya."
            }).then((ok)=>{
              window.location.href = $baseURL + '/';
            });

          }
        }).catch((err)=>{
          console.log(err);
          swal({
            icon: "error",
            title: "Maaf terjadi kesalaha, coba beberapa saat lagi"
          }).then((ok)=>{
            location.reload();
          });

        })

    },

    handleFileUpload(event){
      this.file = event.target.files[0]
    },

    checkTransactionStatus(){
        const urlParams = new URLSearchParams(window.location.search);
        const transaksi_id = urlParams.get('id');

        // console.log(transaksi_id);

        if (transaksi_id) {
          axios.get('/detailTransaksi/' + transaksi_id).then((res) => {
            console.log(res);
            if (_.isEmpty(res.data)) {
              window.location.href = $baseURL + '/';
            }

            if (res.data.status != 'belum_bayar') {
              window.location.href = $baseURL + '/';
            }

            this.transaction_data = res.data;
            this.getBanks();
          }).catch((err)=>{
            window.location.href = $baseURL + '/';
            console.log(err);
          })
        }else {
          window.location.href = $baseURL + '/';
        }
    },

    rupiahFormat(value){
      return $helper.rupiahFormat(value);
    },

  }
})

</script>
@endsection
