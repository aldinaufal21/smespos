@extends('konsumen_app.layouts.app')

@section('title','Checkout')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

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

                                  <div class="single-input-item">
                                      <label for="fullname" class="required">Name</label>
                                      <input type="text" id="fullname" placeholder="Full name" required />
                                  </div>

                                  <div class="single-input-item">
                                      <label class="required">Username</label>
                                      <input type="text" readonly />
                                  </div>

                                  <div class="single-input-item">
                                      <label for="com-name">Nomor Telpon</label>
                                      <input type="text" id="com-name" placeholder="Nomor Telpon" />
                                  </div>

                                  <div class="single-input-item">
                                      <label for="ordernote">Order Note</label>
                                      <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                  </div>
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
                                      <thead>
                                          <tr>
                                              <th><strong>Products</strong></th>
                                              <th><strong>Total</strong></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td><a href="product-details.html">Suscipit Vestibulum <strong> × 1</strong></a>
                                              </td>
                                              <td>$165.00</td>
                                          </tr>
                                          <tr>
                                              <td><a href="product-details.html">Ami Vestibulum suscipit <strong> × 4</strong></a>
                                              </td>
                                              <td>$165.00</td>
                                          </tr>
                                          <tr>
                                              <td><a href="product-details.html">Vestibulum suscipit <strong> × 2</strong></a>
                                              </td>
                                              <td>$165.00</td>
                                          </tr>
                                      </tbody>
                                      <tfoot>
                                          <tr>
                                              <td>Sub Total</td>
                                              <td>$400</td>
                                          </tr>
                                          <tr>
                                              <td>Shipping</td>
                                              <td class="d-flex justify-content-center">
                                                  <ul class="shipping-type">
                                                      <li>
                                                          <div class="custom-control custom-radio">
                                                              <input type="radio" id="flatrate" name="shipping" class="custom-control-input" checked />
                                                              <label class="custom-control-label" for="flatrate">Flat
                                                                  Rate: $70.00</label>
                                                          </div>
                                                      </li>
                                                      <li>
                                                          <div class="custom-control custom-radio">
                                                              <input type="radio" id="freeshipping" name="shipping" class="custom-control-input" />
                                                              <label class="custom-control-label" for="freeshipping">Free
                                                                  Shipping</label>
                                                          </div>
                                                      </li>
                                                  </ul>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>Total Amount</td>
                                              <td>$470</td>
                                          </tr>
                                      </tfoot>
                                  </table>
                              </div>
                              <!-- Order Payment Method -->
                              <div class="order-payment-method">
                                  <div class="single-payment-method show">
                                      <div class="payment-method-name">
                                          <div class="custom-control custom-radio">
                                              <input type="radio" id="cashon" name="paymentmethod" value="cash" class="custom-control-input" checked />
                                              <label class="custom-control-label" for="cashon">Cash On Delivery</label>
                                          </div>
                                      </div>
                                      <div class="payment-method-details" data-method="cash">
                                          <p>Pay with cash upon delivery.</p>
                                      </div>
                                  </div>
                                  <div class="single-payment-method">
                                      <div class="payment-method-name">
                                          <div class="custom-control custom-radio">
                                              <input type="radio" id="directbank" name="paymentmethod" value="bank" class="custom-control-input" />
                                              <label class="custom-control-label" for="directbank">Direct Bank
                                                  Transfer</label>
                                          </div>
                                      </div>
                                      <div class="payment-method-details" data-method="bank">
                                          <p>Make your payment directly into our bank account. Please use your Order
                                              ID as the payment reference. Your order will not be shipped until the
                                              funds have cleared in our account..</p>
                                      </div>
                                  </div>
                                  <div class="summary-footer-area">
                                      <button type="submit" class="btn btn__bg">Place Order</button>
                                  </div>
                              </div>
                          </div>
                      </div>
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
if (!localStorage.getItem('checkout-data')) {
    window.location.href = $baseURL + '/';
}

var checkout_vue = new Vue({
  el: '#vue-checkout',
  data(){
    return{
      token: null,
    }
  },
  created() {
    //do something after mounting vue instance
    this.token = localStorage.getItem('token');
  },
  methods: {

    rupiahFormat(value){
      return $helper.rupiahFormat(value);
    },

  }
})

</script>
@endsection
