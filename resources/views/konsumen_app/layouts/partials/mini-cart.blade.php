<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper" id="mini-cart-vue">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content" id="mini-cart-content">
            <div class="minicart-close">
                <i class="lnr lnr-cross"></i>
            </div>
            <div class="minicart-content-box" v-if="token && cart.length">
                <div class="minicart-item-wrapper">
                    <ul>
                        <li class="minicart-item" v-for="item in cart" :key="item.produk_id">
                            <div class="minicart-thumb">
                                <a href="#">
                                    <img :src="item.gambar_produk" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">@{{ item.nama_produk }}</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">@{{ item.quantity }} <strong>&times;</strong></span>
                                    <span class="cart-price">@{{ rupiahFormat(item.harga) }}</span>
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
                            <span><strong>Rp @{{ rupiahFormat(total) }}</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="{{ route('konsumen.cart') }}"><i class="fa fa-shopping-cart"></i> view cart</a>
                    <a href="javascript:void(0)" @click="checkout"><i class="fa fa-share"></i> checkout</a>
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
        token: null,
        cart: [],
        total: 0
      }
    },
    created() {
      //do something after mounting vue instance
      this.token = localStorage.getItem('token');
      this.getCartItem();
      this.countWishlist();
    },
    methods: {
      getCartItem() {
        if (this.token) {
            cartStore.getCart().then((res)=>{
              // console.log(res);
              this.cart = res.data;

              this.total = 0;
              this.cart.forEach((item, i) => {
                this.total += item.harga * item.quantity
              });

              $('#cart-notification').text(this.cart.length);
            });
        }
      },

      updateCart(){
        this.getCartItem();
      },

      checkout(){
        $.LoadingOverlay("show");
        const payload = {
          items: this.cart,
        }
        cartStore.storeCheckoutData(payload);
        window.location.href = $baseURL + '/checkout';
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
                $('#mini-cart-content').LoadingOverlay("show");
                // console.log(res);
                if (res.status == 200) {
                  this.getCartItem();
                  this.updateCart();
                }
              }).finally(()=>{
                $('#mini-cart-content').LoadingOverlay("hide");
              });
            }
          });
      },

      countWishlist(){
        if (this.token) {
          axios.get('favorite-product').then((res)=>{
            // console.log(res);

            $('#wishlist-notification').text(res.data.length);
          }).catch((err)=>{
            console.log(err);
          })
        }
      },

      rupiahFormat(value){
        return $helper.rupiahFormat(value);
      },

    }
  })
</script>
