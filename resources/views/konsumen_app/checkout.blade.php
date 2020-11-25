@extends('konsumen_app.layouts.app')

@section('title','Checkout')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">
  #reset-this {
    all: initial;
    * {
        all: unset;
    }
  }
</style>
@endsection

@section('content')
  <!-- main wrapper start -->
  <main id="vue-checkout">
      <breadcrumb :title="'Checkout'"></breadcrumb>

      <!-- checkout main wrapper start -->
      <div class="checkout-page-wrapper section-space pb-0">
          <div class="container">
              <div class="row">
                  <!-- Checkout Billing Details -->
                  <div class="col-lg-6">
                      <div class="checkout-billing-details-wrap">
                          <h2>Billing Details</h2>
                          <div class="billing-form-wrap">
                              <form action="#">

                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="single-input-item">
                                          <label for="fullname" class="required">Name</label>
                                          <input type="text" id="fullname" placeholder="Full name" readonly required v-model="profile_detail.nama_konsumen"/>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="single-input-item">
                                          <label class="required">Username</label>
                                          <input type="text" readonly v-model="profile_detail.username"/>
                                      </div>
                                    </div>
                                </div>

                                  <div class="single-input-item">
                                      <label for="com-name">Nomor Telpon</label>
                                      <input type="text" id="com-name" placeholder="Nomor Telpon" v-model="profile_detail.nomor_hp"/>
                                  </div>

                                  <div class="single-input-item">
                                      <label for="ordernote">Order Note</label>
                                      <textarea name="ordernote" id="ordernote" cols="30" rows="3" v-model="checkout_data.catatan_order" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                  </div>

                                  {{-- <div class="myaccount-content">
                                      <h3>Billing Address</h3>
                                      <a href="#" class="btn btn__bg">Pilih Alamat</a>
                                      <br><br>
                                      <address v-if="choosen_address">
                                          <p><strong>Nama Konsumen</strong></p>
                                          <p></p>
                                          <p>Mobile: (123) 456-7890</p>
                                          <a href="#" class="btn btn__bg"><i class="fa fa-edit"></i>Edit Address</a>
                                          <hr>
                                      </address>
                                  </div> --}}
                              </form>
                          </div>
                      </div>
                  </div>

                  <!-- Order Summary Details -->
                  <div class="col-lg-6">
                      <div class="order-summary-details">
                          <h2>Your Order Summary</h2>
                          <div class="order-summary-content">
                              <!-- Order Summary Table -->
                              <div class="order-summary-table table-responsive text-center">
                                  <table class="table table-bordered">
                                      <thead style="background-color:#ededed;">
                                          <tr>
                                              <th><strong>Products</strong></th>
                                              <th><strong>Total</strong></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr v-for="item in items" :key="item.produk_id">
                                              <td><a href="#">@{{ item.nama_produk }} <strong> × @{{ item.quantity }}</strong></a>
                                              </td>
                                              <td>Rp @{{ rupiahFormat(item.harga * item.quantity) }}</td>
                                          </tr>
                                      </tbody>
                                      <tfoot style="background-color:#ededed;">
                                          <tr>
                                              <td>Sub Total</td>
                                              <td>Rp @{{ rupiahFormat(bill.subtotal) }}</td>
                                          </tr>
                                          <tr>
                                              <td>Shipping</td>
                                              <td class="d-flex justify-content-center">
                                                  Rp @{{ rupiahFormat(bill.shipping) }}
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>Total Amount</td>
                                              <td>Rp @{{ rupiahFormat(bill.total) }}</td>
                                          </tr>
                                      </tfoot>
                                  </table>
                              </div>
                              <!-- Order Payment Method -->
                              <div class="order-payment-method">
                                  <div class="single-payment-method">
                                      <div class="payment-method-name">
                                          <div class="custom-control custom-radio">
                                              <input type="radio" id="directbank" name="paymentmethod" value="delivery" @click="bill.shipping = 12000" v-model="checkout_data.jenis_order" class="custom-control-input" checked />
                                              <label class="custom-control-label" for="directbank">Delivery</label>
                                          </div>
                                      </div>
                                      <div class="payment-method-details" data-method="delivery">
                                        <select class="form-control">
                                          <option value="0">Kota/Kabupaten Bandung</option>
                                        </select>
                                        <br>
                                        <address>
                                            <p><strong>Detail Alamat: </strong></p>
                                            <p v-text="address.alamat"></p>
                                            <p>Mobile: (123) 456-7890</p>
                                        </address>
                                        <br>
                                        <a href="#" class="btn btn-warning"><i class="fa fa-edit"></i>Edit Address</a>
                                      </div>
                                  </div>
                                  <div class="single-payment-method show">
                                      <div class="payment-method-name">
                                          <div class="custom-control custom-radio">
                                              <input type="radio" id="cashon" name="paymentmethod" value="take_away" @click="bill.shipping = 0" v-model="checkout_data.jenis_order" class="custom-control-input" />
                                              <label class="custom-control-label" for="cashon">Take Away</label>
                                          </div>
                                      </div>
                                      <div class="payment-method-details" data-method="take_away">
                                          <p>Ambil produk di toko langsung, tanpa biaya tambahan.</p>
                                      </div>
                                  </div>
                                  <div class="summary-footer-area">
                                      <button type="button" @click="doOrder" class="btn btn__bg">Place Order</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- checkout main wrapper end -->

      <!-- Quick view modal start -->
      <div class="modal" id="choose-address">
          <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">

                  </div>
              </div>
          </div>
      </div>
      <!-- Quick view modal end -->
  </main>
  <!-- main wrapper end -->
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>
$auth.needAuthentication();
var _checkout_data = localStorage.getItem('checkout-data');
if (!_checkout_data) {
    window.location.href = $baseURL + '/';
}else {
  _checkout_data = JSON.parse(_checkout_data);
}

var checkout_vue = new Vue({
  el: '#vue-checkout',
  data(){
    return{
      token: null,
      banks: [],
      items: _checkout_data.items,
      cabang_id: _checkout_data.cabang_id,
      bill: {
        subtotal: 0,
        total: 0,
        shipping: 12000
      },
      address: {
        alamat: null,
        alamat_pengiriman_id: null,
        data_provinsi: [],
        data_kota: []
      },
      choosen_address: null,
      profile_detail: {
        nama_konsumen: '',
        nomor_hp: '',
        alamat_konsumen: '',
        username: ''
      },
      checkout_data: {
        catatan_order: '',
        jenis_order: 'delivery',
        bank_id: null,
        catatan_order: ''
      }
    }
  },
  created() {
    //do something after mounting vue instance
    this.token = localStorage.getItem('token');
    this.getUserDetails();
    this.getBanks();
    this.getAddress();
    this.calculateTotal();
  },
  mounted() {
    //do something after mounting vue instance
    // console.log(this.items);
    this.getDataProvinsiKota();
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

    getBanks(){
      axios.get('/bank').then((res)=>{
        console.log(res);
        this.banks = res.data;
      }).catch((err)=>{
        console.log(err);
      });
    },

    getAddress() {
      axios.get('consumer/addresses').then((res)=>{
        console.log(res);
        this.address = res.data[0];
      }).catch((err)=>{
        console.log(err);
      })
    },

    getDataProvinsiKota(){
      let config = {
        headers: {
          'key': 'pigoorafreeservices',
          'Access-Control-Allow-Origin': '*',
          'Access-Control-Allow-Methods': '*',
          'Access-Control-Allow-Headers': '*',
          crossDomain: true,
        }
      }

      // axios.get('https://api.cekresi.pigoora.com/provinsi?key=pigoorafreeservices', {}, config).then((res)=>{
      //   console.log(res);
      // }).catch((err)=>{
      //   console.log(err);
      // })
    },

    calculateTotal(){
      this.bill.subtotal = 0;

      this.items.forEach((item, i) => {
        this.bill.subtotal += item.harga * item.quantity
      });

      this.bill.total = this.bill.subtotal + this.bill.shipping;
    },

    doOrder(){
      let produk = [];
      for (let item of this.items) {
        produk.push({
          produk_id: item.produk_id,
          jumlah: item.quantity
        })
      }

      const payload = {
        konsumen_id: this.profile_detail.konsumen_id,
        ...this.checkout_data,
        produk: produk,
        alamat_pengiriman_id: this.address.alamat_pengiriman_id,
        cabang_id: this.cabang_id,
        ongkir: this.bill.shipping
      }

      axios.post('/createTransaksiKonsumen', payload).then((res)=>{
        if (res.status == 201) {
          // console.log(res);
          // console.log("success");

          window.location.href = $baseURL + '/payment?id=' + res.data.transaksi_konsumen_id;

          localStorage.removeItem('checkout-data');
        }
      }).catch((err)=>{
        console.log(err);
      });
    },

    emptyCart(){

    },

    rupiahFormat(value){
      return $helper.rupiahFormat(value);
    },

  }
})

</script>
@endsection
