<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper" id="mini-cart-vue">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="lnr lnr-cross"></i>
            </div>
            <div class="minicart-content-box" v-if="token && cart.length">
                <div class="minicart-item-wrapper">
                    <ul>
                        <li class="minicart-item" v-for="item in cart" :key="item.produk_id">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="{{ asset('konsumen_assets/img/cart/cart-1.jpg') }}" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">@{{ item.produk.nama_produk }}</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">@{{ item.quantity }} <strong>&times;</strong></span>
                                    <span class="cart-price">@{{ item.produk.harga }}</span>
                                </p>
                            </div>
                            <button class="minicart-remove" @click="deleteItem(item.produk_id)"><i class="lnr lnr-cross"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li class="total">
                            <span>total</span>
                            <span><strong>Rp. @{{ total }}</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="{{ route('konsumen.cart') }}"><i class="fa fa-shopping-cart"></i> view cart</a>
                    <a href="{{ route('konsumen.checkout') }}"><i class="fa fa-share"></i> checkout</a>
                </div>
            </div>

            <div class="minicart-content-box" v-if="token && !cart.length">
              <h3>Keranjang anda kosong :(</h3>
              <p>Silahkan masukan produk ke keranjang</p>
            </div>

            <div class="minicart-content-box" v-if="!token">
              <h2>Anda harus login terlebih dahulu!</h2>
              <br><br>
              <div class="minicart-button">
                <a href="{{ route('konsumen.login') }}"><i class="fa fa-sign-in"></i> Login</a>
                <center>or</center>
                <a href="{{ route('konsumen.register') }}"><i class="fa fa-user-plus"></i> Register</a>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->

<script type="text/javascript">
  var mini_cart_vue = new Vue({
    el: '#mini-cart-vue',
    data(){
      return{
        item: 2,
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
            axios.get('/cart').then((res)=>{
              console.log(res);
              this.cart = res.data;
              $('#cart-notification').text(this.cart.length);
            }).catch((err)=>{
              console.log(err);
            });
        }else {
          console.log("belum login");
        }
      },

      deleteItem(produk_id){
        // do delete item
        this.getCartItem();
      },

    }
  })
</script>
