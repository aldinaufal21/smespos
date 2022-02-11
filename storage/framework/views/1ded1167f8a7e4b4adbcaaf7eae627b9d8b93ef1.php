<?php $__env->startSection('title','Home'); ?>

<?php $__env->startSection('extra_head'); ?>
<!-- Custom styles for this page -->
<style media="screen">
  .slider-blur {
    display: block;
    position: absolute;
    top: inherit;
    left: inherit;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .4);
    z-index: 1;
  }
  .hero-slider-content {
    position: relative;
    z-index: 2;
  }
  .hero-slider-content > h1, .hero-slider-content > h2 {
    color: #f5f5f3;
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- main wrapper start -->
  <main id="home-container">
      <!-- slider area start -->
      <section class="slider-area">
          <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
              <!-- single slider item start -->
              <div class="hero-single-slide " v-for="i in 3">
                  <div class="hero-slider-item_3 bg-img" :data-bg="`konsumen_assets/img/banner/banner${i}.jpg`">
                      <div class="slider-blur"></div>
                      <div class="container ">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="hero-slider-content slide-1">
                                      <span style="color: #FE914A">POS</span>
                                      <h1>Berbagai macam Produk</h1>
                                      <h2>dari berbagai macam UMKM</h2>
                                      <a href="<?php echo e(route('konsumen.shop')); ?>" class="btn-hero" style="background-color: #FE914A">Belanja Sekarang</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- single slider item end -->

              <!-- single slider item start -->
              
              <!-- single slider item end -->
          </div>
      </section>
      <!-- slider area end -->

      <!-- service policy start -->
      <section class="service-policy-area section-space">
          <div class="container">
              <div class="row">
                  <div class="col-lg-3 col-md-6 col-sm-6">
                      <!-- start policy single item -->
                      <div class="service-policy-item">
                          <div class="icons">
                              <img src="konsumen_assets/img/icon/free_shipping.png" alt="">
                          </div>
                          <div class="policy-terms">
                              <h5>Gratis Ongkir</h5>
                              <p>Gratis Ongkir untuk semua pembelian</p>
                          </div>
                      </div>
                      <!-- end policy single item -->
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                      <!-- start policy single item -->
                      <div class="service-policy-item">
                          <div class="icons">
                              <img src="konsumen_assets/img/icon/support247.png" alt="">
                          </div>
                          <div class="policy-terms">
                              <h5>Support 24/7</h5>
                              <p>Support 24 jam setiap hari</p>
                          </div>
                      </div>
                      <!-- end policy single item -->
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                      <!-- start policy single item -->
                      <div class="service-policy-item">
                          <div class="icons">
                              <img src="konsumen_assets/img/icon/money_back.png" alt="">
                          </div>
                          <div class="policy-terms">
                              <h5>Uang Kembali</h5>
                              <p>30 hari untuk pengembalian gratis</p>
                          </div>
                      </div>
                      <!-- end policy single item -->
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-6">
                      <!-- start policy single item -->
                      <div class="service-policy-item">
                          <div class="icons">
                              <img src="konsumen_assets/img/icon/promotions.png" alt="">
                          </div>
                          <div class="policy-terms">
                              <h5>Diskon</h5>
                              <p>Pada setiap pesanan lebih dari Rp. 100.000</p>
                          </div>
                      </div>
                      <!-- end policy single item -->
                  </div>
              </div>
          </div>
      </section>
      <!-- service policy end -->

      <!-- our product area start -->
      <section class="our-product section-space">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="section-title text-center">
                          <h2>Produk Terbaru</h2>
                          <p>Produk - produk terbaru dari berbagai umkm</p>
                      </div>
                  </div>
              </div>
              <div class="row mtn-40">
                <!-- product single item start -->
                <div class="col-md-4 col-sm-6" v-for="(produk, index) in products" :key="produk.produk_id" style="margin-bottom:20px;">
                  <!-- product grid start -->
                  <div class="product-item">
                    <figure class="product-thumb">
                      <a href="javascript:void(0)">
                        <img class="pri-img" :src="produk.gambar_produk" alt="product">
                        <img class="sec-img" :src="produk.gambar_produk" alt="product">
                      </a>
                      <div class="button-group">
                        <a href="javascript:void(0)" @click="addToWishlist(produk.produk_id)" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="lnr lnr-heart"></i></a>
                        <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                        
                      </div>
                    </figure>
                    <div class="product-caption">
                      <p class="product-name">
                        <a href="product-details.html" v-text="produk.nama_produk"></a>
                      </p>
                      <div class="price-box">
                        <span class="price-regular">Rp. {{ rupiahFormat(produk.harga) }}</span>
                      </div>
                    </div>
                  </div>
                  <!-- product grid end -->
                </div>
                <!-- product single item start -->

                  <div class="col-12">
                      <div class="view-more-btn">
                          <a class="btn-hero btn-load-more" style="background-color: #FE914A" href="<?php echo e(route('konsumen.produk')); ?>">view more products</a>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- our product area end -->

  </main>
  <!-- main wrapper end -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra_script'); ?>
<!-- Page level plugins -->
<script>
  // var user = $auth.userCredentials();

  var vue_home = new Vue({
    el: '#home-container',
    data(){
      return {
        products: [],
      }
    },

    mounted() {
      //do something after mounting vue instance
      this.getProduct();
    },

    methods: {
      getProduct() {
        axios.get('product/latest/items?limit=6').then((res) => {
          // console.log(res);
          this.products = res.data;
        }).catch((err) => {
          console.log(err);
        })
      },

      addToCart(produk_id) {
        // $auth.needAuthentication();
        // mini_cart_vue.item++;
        const payload = {
          produk_id: produk_id,
          quantity: 1
        }

        cartStore.addCart(payload).then((res) => {
          mini_cart_vue.updateCart();
        })
      },

      addToWishlist(produk_id) {
        axios.post('favorite-product', {
          produk_id: produk_id
        }).then((res) => {
          if (res.status == 201) {
            swal({
              icon: "success",
              title: "Produk berhasil dimasukkan ke wishlist"
            });
            mini_cart_vue.countWishlist();
          }
        }).catch((err) => {
          console.log(err);
          $helper.errorModal(err);
        })
      },

      rupiahFormat(value){
        return $helper.rupiahFormat(value);
      },
    }
  });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('konsumen_app.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/izharauliataqwa/Documents/project/idukafix/resources/views/konsumen_app/home.blade.php ENDPATH**/ ?>