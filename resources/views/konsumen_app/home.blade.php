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

      <!-- trending product area start -->
      <section class="deals-area section-space pt-0">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="section-title text-center">
                          <h2>Deals Of The Month</h2>
                          <p>Accumsan vitae pede lacus ut ullamcorper sollicitudin quisque libero</p>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-lg-12">
                      <div class="product-deal-carousel--2 slick-row-15 slick-sm-row-10 slick-arrow-style">
                          <!-- product single item start -->
                          <div class="deal-slide">
                              <div class="product-item deal-item">
                                  <figure class="product-thumb">
                                      <a href="product-details.html">
                                          <img class="pri-img" src="konsumen_assets/img/product/product-13.jpg" alt="product">
                                          <img class="sec-img" src="konsumen_assets/img/product/product-7.jpg" alt="product">
                                      </a>
                                      <div class="product-badge">
                                          <div class="product-label new">
                                              <span>new</span>
                                          </div>
                                      </div>
                                      <div class="button-group">
                                          <a href="wishlist.html" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="lnr lnr-heart"></i></a>
                                          <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                                          <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><i class="lnr lnr-cart"></i></a>
                                      </div>
                                  </figure>
                                  <div class="product-caption product-deal-content">
                                      <p class="product-name">
                                          <a href="product-details.html">Blossom bouquet flower</a>
                                      </p>
                                      <div class="ratings d-flex mb-1">
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                      </div>
                                      <div class="price-box">
                                          <span class="price-regular">$40.00</span>
                                          <span class="price-old"><del>$60.00</del></span>
                                      </div>
                                      <div class="countdown-titmer mt-3">
                                          <h5 class="offer-text"><strong class="text-danger">Hurry up</strong>! offer ends in:</h5>
                                          <div class="product-countdown" data-countdown="2020/05/20"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- product single item end -->

                          <!-- product single item start -->
                          <div class="deal-slide">
                              <div class="product-item deal-item">
                                  <figure class="product-thumb">
                                      <a href="product-details.html">
                                          <img class="pri-img" src="konsumen_assets/img/product/product-6.jpg" alt="product">
                                          <img class="sec-img" src="konsumen_assets/img/product/product-9.jpg" alt="product">
                                      </a>
                                      <div class="product-badge">
                                          <div class="product-label new">
                                              <span>new</span>
                                          </div>
                                      </div>
                                      <div class="button-group">
                                          <a href="wishlist.html" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="lnr lnr-heart"></i></a>
                                          <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                                          <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><i class="lnr lnr-cart"></i></a>
                                      </div>
                                  </figure>
                                  <div class="product-caption product-deal-content">
                                      <p class="product-name">
                                          <a href="product-details.html">Jasmine flowers white</a>
                                      </p>
                                      <div class="ratings d-flex mb-1">
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                      </div>
                                      <div class="price-box">
                                          <span class="price-regular">$50.00</span>
                                          <span class="price-old"><del>$70.00</del></span>
                                      </div>
                                      <div class="countdown-titmer mt-3">
                                          <h5 class="offer-text"><strong class="text-danger">Hurry up</strong>! offer ends in:</h5>
                                          <div class="product-countdown" data-countdown="2020/04/25"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- product single item end -->

                          <!-- product single item start -->
                          <div class="deal-slide">
                              <div class="product-item deal-item">
                                  <figure class="product-thumb">
                                      <a href="product-details.html">
                                          <img class="pri-img" src="konsumen_assets/img/product/product-14.jpg" alt="product">
                                          <img class="sec-img" src="konsumen_assets/img/product/product-8.jpg" alt="product">
                                      </a>
                                      <div class="product-badge">
                                          <div class="product-label new">
                                              <span>new</span>
                                          </div>
                                      </div>
                                      <div class="button-group">
                                          <a href="wishlist.html" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="lnr lnr-heart"></i></a>
                                          <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                                          <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><i class="lnr lnr-cart"></i></a>
                                      </div>
                                  </figure>
                                  <div class="product-caption product-deal-content">
                                      <p class="product-name">
                                          <a href="product-details.html">Flowers daisy pink stick</a>
                                      </p>
                                      <div class="ratings d-flex mb-1">
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                          <span><i class="lnr lnr-star"></i></span>
                                      </div>
                                      <div class="price-box">
                                          <span class="price-regular">$35.00</span>
                                          <span class="price-old"><del>$45.00</del></span>
                                      </div>
                                      <div class="countdown-titmer mt-3">
                                          <h5 class="offer-text"><strong class="text-danger">Hurry up</strong>! offer ends in:</h5>
                                          <div class="product-countdown" data-countdown="2020/03/25"></div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- product single item end -->
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- trending product area end -->

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
                          <a class="btn-hero btn-load-more" href="shop.html">view more products</a>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- our product area end -->

      <!-- latest news area start -->
      <section class="latest-news section-space pt-0">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="section-title text-center">
                          <h2>latest blog</h2>
                          <p>Accumsan vitae pede lacus ut ullamcorper sollicitudin quisque libero</p>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-12">
                      <div class="latest-blog-carousel slick-arrow-style slick-row-15">
                          <!-- blog sinle post start -->
                          <div class="blog-post-item" v-for="i in 4">
                              <div class="blog-post-thumb">
                                  <a href="blog-details.html">
                                      <img src="konsumen_assets/img/blog/blog-details-4.jpg" alt="">
                                  </a>
                                  <div class="post-date">
                                      <p class="date">25</p>
                                      <p class="month">Apr</p>
                                  </div>
                              </div>
                              <div class="post-info-wrapper">
                                  <div class="entry-header">
                                      <h2 class="entry-title">
                                          <a href="blog-details.html">Flowers daisy pink stick</a>
                                      </h2>
                                      <div class="post-meta">
                                          <div class="post-author">
                                              Written by: <a href="#">Admin</a>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="entry-summary">
                                      <p>Donec vitae hendrerit arcu, sit amet faucibus nisl. Cras pretium arcu ex. Aenean
                                          posuere libero eu augue.
                                      </p>
                                  </div>
                                  <a href="blog-details.html" class="btn-read">read more...</a>
                              </div>
                          </div>
                          <!-- blog sinle post end -->
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- latest news area end -->

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
