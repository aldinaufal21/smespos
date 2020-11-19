@extends('konsumen_app.layouts.app')

@section('title','Checkout')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
  <!-- main wrapper start -->
  <main id="cart-vue">
      <breadcrumb :title="'Cart'"></breadcrumb>

      <!-- cart main wrapper start -->
      <div class="cart-main-wrapper section-space pb-0">
          <div class="container">
              <div class="section-bg-color">
                  <div class="row">
                      <div class="col-lg-12">
                          <!-- Cart Table Area -->
                          <div class="cart-table table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th class="pro-thumbnail">Thumbnail</th>
                                          <th class="pro-title">Product</th>
                                          <th class="pro-price">Price</th>
                                          <th class="pro-quantity">Quantity</th>
                                          <th class="pro-subtotal">Total</th>
                                          <th class="pro-remove">Remove</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr v-for="item in cart" :key="item.produk_id">
                                          <td class="pro-thumbnail"><a href="#"><img class="img-fluid" :src="item.gambar_produk" alt="Product" /></a></td>
                                          <td class="pro-title"><a href="#" v-text="item.nama_produk"></a></td>
                                          <td class="pro-price">Rp <span v-text="rupiahFormat(item.harga)"></span></td>
                                          <td class="pro-quantity">
                                              <div class="pro-qty">
                                                <span class="dec qtybtn" @click="(item.quantity>1)?item.quantity--:''; updateQuantity(item.quantity, item.produk_id)">-</span>
                                                <input type="text" v-model="item.quantity" @change="updateQuantity($event, item.produk_id)" @keyup="updateQuantity($event, item.produk_id)">
                                                <span class="inc qtybtn" @click="item.quantity++; updateQuantity(item.quantity, item.produk_id)">+</span>
                                              </div>
                                              {{-- <div class="pro-qty"><input type="text" :value="item.quantity" @change="updateQuantity($event, item.produk_id)" @keyup="updateQuantity($event, item.produk_id)"></div> --}}
                                          </td>
                                          <td class="pro-subtotal"><span v-text="rupiahFormat( item.harga * item.quantity )"></span></td>
                                          <td class="pro-remove"><a href="#" @click="deleteItem(item.produk_id)"><i class="fa fa-trash-o"></i></a></td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-5 ml-auto">
                          <!-- Cart Calculation Area -->
                          <div class="cart-calculator-wrapper">
                              <div class="cart-calculate-items">
                                  <h3>Cart Totals</h3>
                                  <div class="table-responsive">
                                      <table class="table">
                                          {{-- <tr>
                                              <td>Sub Total</td>
                                              <td>$230</td>
                                          </tr>
                                          <tr>
                                              <td>Shipping</td>
                                              <td>$70</td>
                                          </tr> --}}
                                          <tr class="total">
                                              <td>Total</td>
                                              <td class="total-amount" v-text="rupiahFormat(total)"></td>
                                          </tr>
                                      </table>
                                  </div>
                              </div>
                              <a href="checkout.html" class="btn btn__bg d-block">Proceed To Checkout</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- cart main wrapper end -->
  </main>
  <!-- main wrapper end -->
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>
  $auth.needAuthentication();

  var cart_vue = new Vue({
    el: '#cart-vue',
    data(){
      return{
        token: null,
        cart: [],
        total: 0
      }
    },
    created() {
      //do something after mounting vue instance
      this.token = localStorage.getItem('token');
      this.getCartItem();
    },
    methods: {
      getCartItem() {
        if (this.token) {
            cartStore.getCart().then((res)=>{
              // console.log(res);
              this.cart = res.data;
              this.calculateSubtotal();
            });
        }else {
          console.log("belum login");
        }
      },

      deleteItem(produk_id){
        // do delete item
        $swal({
            title: "Anda yakin?",
            text: "Data akan dihapus!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((deleteData)=>{
            if (deleteData) {
              cartStore.destroyCart(produk_id).then((res)=>{
                // console.log(res);
                if (res.status == 200) {
                  this.getCartItem();
                  mini_cart_vue.updateCart();
                }
              });
            }
          });
      },

      calculateSubtotal(){
        this.total = 0;

        this.cart.forEach((item, i) => {
          this.total += item.harga * item.quantity
        });
      },

      updateQuantity(quantity, produk_id){
        const payload = {
          data: {
            quantity: quantity
          },
          id: produk_id
        }

        cartStore.updateCart(payload).then((res)=>{
          let index = this.cart.findIndex(cartItem => cartItem.produk_id == produk_id)
          if (index != -1) {
            if (quantity) {
              this.cart[index].quantity = quantity;
            }
          }

          this.calculateSubtotal();
        });

      },

      rupiahFormat(value){
        return $helper.rupiahFormat(value);
      },

    }
  })

</script>
@endsection
