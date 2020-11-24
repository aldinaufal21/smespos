@extends('konsumen_app.layouts.app')

@section('title','Home')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
  <!-- main wrapper start -->
  <main id="home-container">
      <!-- slider area start -->
      <section class="slider-area">
          <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
              <!-- single slider item start -->
              <div class="hero-single-slide " v-for="i in 5">
                  <div class="hero-slider-item_3 bg-img" data-bg="konsumen_assets/img/slider/home3-slide1.jpg">
                      <div class="container">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="hero-slider-content slide-1">
                                      <span>POS</span>
                                      <h1>Dapatkan Diskon @{{ i }}</h1>
                                      <h2>disetiap pembelian</h2>
                                      <a href="shop.html" class="btn-hero">shop now</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
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
                              <h5>free shipping</h5>
                              <p>Free shipping all order</p>
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
                              <h5>SUPPORT 24/7</h5>
                              <p>Support 24 hours a day</p>
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
                              <h5>Money Return</h5>
                              <p>30 days for free return</p>
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
                              <h5>ORDER DISCOUNT</h5>
                              <p>On every order over $15</p>
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
                          <h2>New Products</h2>
                          <p>Accumsan vitae pede lacus ut ullamcorper sollicitudin quisque libero</p>
                      </div>
                  </div>
              </div>
              <div class="row mtn-40">
                  <!-- product single item start -->
                  <div class="col-lg-3 col-md-4 col-sm-6" v-for="i in 8">
                      <div class="product-item mt-40">
                          <figure class="product-thumb">
                              <a href="product-details.html">
                                  <img class="pri-img" src="konsumen_assets/img/product/product-1.jpg" alt="product">
                                  <img class="sec-img" src="konsumen_assets/img/product/product-2.jpg" alt="product">
                              </a>
                              <div class="product-badge">
                                  <div class="product-label new">
                                      <span>new</span>
                                  </div>
                                  <div class="product-label discount">
                                      <span>10%</span>
                                  </div>
                              </div>
                              <div class="button-group">
                                  <a href="wishlist.html" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="lnr lnr-heart"></i></a>
                                  <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                                  <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><i class="lnr lnr-cart"></i></a>
                              </div>
                          </figure>
                          <div class="product-caption">
                              <p class="product-name">
                                  <a href="product-details.html">Flowers bouquet pink</a>
                              </p>
                              <div class="price-box">
                                  <span class="price-regular">$60.00</span>
                                  <span class="price-old"><del>$70.00</del></span>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- product single item end -->

                  <div class="col-12">
                      <div class="view-more-btn">
                          <a class="btn-hero btn-load-more" href="{{ route('konsumen.produk') }}">view more products</a>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- our product area end -->

  </main>
  <!-- main wrapper end -->
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>
  // var user = $auth.userCredentials();

  var vue_home = new Vue({
    el: '#home-container',
    data(){
      return {

      }
    },

    mounted() {
      //do something after mounting vue instance

    },

    methods: {

    }
  });

</script>
@endsection
