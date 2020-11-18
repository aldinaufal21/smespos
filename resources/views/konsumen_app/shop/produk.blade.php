@extends('konsumen_app.layouts.app')

@section('title','Shop')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
<div id="vue-product">
  <!-- main wrapper start -->
  <main>
      <breadcrumb :title="'Produk'"></breadcrumb>

      <!-- PILIH PRODUK -->
      <div class="shop-main-wrapper section-space pb-0">
          <div class="container">
              <div class="row">
                  <!-- sidebar area start -->
                  <div class="col-lg-3 order-2 order-lg-1">
                      <aside class="sidebar-wrapper">
                          <!-- single sidebar start -->
                          <div class="sidebar-single">
                              <h3 class="sidebar-title">categories</h3>
                              <div class="sidebar-body">
                                  <ul class="shop-categories">
                                      <li><a href="#">Jasmine <span>10</span></a></li>
                                      <li><a href="#">Rose <span>5</span></a></li>
                                      <li><a href="#">Orchid <span>8</span></a></li>
                                      <li><a href="#">Blossom <span>4</span></a></li>
                                      <li><a href="#">Hyacinth <span>5</span></a></li>
                                      <li><a href="#">Bouquet <span>2</span></a></li>
                                  </ul>
                              </div>
                          </div>
                          <!-- single sidebar end -->

                          <!-- single sidebar start -->
                          <div class="sidebar-single">
                              <h3 class="sidebar-title">price</h3>
                              <div class="sidebar-body">
                                  <div class="price-range-wrap">
                                      <div class="price-range" data-min="0" data-max="1000"></div>
                                      <div class="range-slider">
                                          <form action="#" class="d-flex align-items-center justify-content-between">
                                              <div class="price-input">
                                                  <label for="amount">Price: </label>
                                                  <input type="text" id="amount">
                                              </div>
                                              <button class="filter-btn">filter</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- single sidebar end -->

                          <!-- single sidebar start -->
                          <div class="sidebar-single">
                              <h3 class="sidebar-title">size</h3>
                              <div class="sidebar-body">
                                  <ul class="checkbox-container categories-list">
                                      <li>
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input" id="customCheck111">
                                              <label class="custom-control-label" for="customCheck111">S (4)</label>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input" id="customCheck222">
                                              <label class="custom-control-label" for="customCheck222">M (5)</label>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input" id="customCheck333">
                                              <label class="custom-control-label" for="customCheck333">L (7)</label>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input" id="customCheck444">
                                              <label class="custom-control-label" for="customCheck444">XL (3)</label>
                                          </div>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                          <!-- single sidebar end -->
                      </aside>
                  </div>
                  <!-- sidebar area end -->

                  <!-- shop main wrapper start -->
                  <div class="col-lg-9 order-1 order-lg-2">
                      <div class="shop-product-wrapper">
                          <!-- shop product top wrap start -->
                          <div class="shop-top-bar">
                              <div class="row align-items-center">
                                  <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                      <div class="top-bar-left">
                                          <div class="product-view-mode">
                                              <a class="active" href="#" data-target="grid-view" data-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                              <a href="#" data-target="list-view" data-toggle="tooltip" title="List View"><i class="fa fa-list"></i></a>
                                          </div>
                                          <div class="product-amount">
                                              <p>Showing 1–5 of 8 results</p>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                      <div class="top-bar-right">
                                          <div class="product-short">
                                              <p>Sort By : </p>
                                              <select class="nice-select" name="sortby">
                                                  <option value="trending">Relevance</option>
                                                  <option value="sales">Name (A - Z)</option>
                                                  <option value="sales">Name (Z - A)</option>
                                                  <option value="rating">Price (Low &gt; High)</option>
                                                  <option value="date">Rating (Lowest)</option>
                                                  <option value="price-asc">Model (A - Z)</option>
                                                  <option value="price-asc">Model (Z - A)</option>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- shop product top wrap start -->

                          <!-- product item list wrapper start -->
                          <div class="shop-product-wrap grid-view row mbn-40">
                              <!-- product single item start -->
                              <div class="col-md-4 col-sm-6" v-for="(produk, index) in products" :key="produk.produk_id">
                                  <!-- product grid start -->
                                  <div class="product-item">
                                      <figure class="product-thumb">
                                          <a href="javascript:void(0)">
                                              <img class="pri-img" :src="produk.gambar_produk" alt="product">
                                              <img class="sec-img" :src="produk.gambar_produk" alt="product">
                                          </a>
                                          <div class="button-group">
                                            <a href="wishlist.html" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="lnr lnr-heart"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                                            <a href="javascript:void(0)" @click="addToCart" data-toggle="tooltip" data-placement="left" title="Add to Cart"><i class="lnr lnr-cart"></i></a>
                                          </div>
                                      </figure>
                                      <div class="product-caption">
                                          <p class="product-name">
                                              <a href="product-details.html" v-text="produk.nama_produk"></a>
                                          </p>
                                          <div class="price-box">
                                              <span class="price-regular">Rp. @{{ produk.harga }}</span>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- product grid end -->

                                  <!-- product list item end -->
                                  <div class="product-list-item">
                                      <figure class="product-thumb">
                                          <a href="javascript:void(0)">
                                            <img class="pri-img" :src="produk.gambar_produk" alt="product">
                                            <img class="sec-img" :src="produk.gambar_produk" alt="product">
                                          </a>
                                      </figure>
                                      <div class="product-content-list">
                                          <h5 class="product-name"><a href="product-details.html" v-text="produk.nama_produk"></a></h5>
                                          <p v-text="produk.deskripsi_produk"></p>
                                          <div class="button-group-list">
                                            <a @click="addToCart" class="btn-big" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="lnr lnr-cart"></i>Add to Cart</a>
                                            <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip" data-placement="top" title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                                            <a href="wishlist.html" data-toggle="tooltip" title="Add to wishlist"><i class="lnr lnr-heart"></i></a>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- product list item end -->
                              </div>
                              <!-- product single item start -->
                          </div>
                          <!-- product item list wrapper end -->
                      </div>
                  </div>
                  <!-- shop main wrapper end -->
              </div>
          </div>
      </div>
      <!-- /PILIH PRODUK -->
  </main>
  <!-- main wrapper end -->

  <!-- Quick view modal start -->
  <div class="modal" id="produk_detail">
      <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <p>Hello</p>
              </div>
          </div>
      </div>
  </div>
  <!-- Quick view modal end -->
</div>
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>
  const urlParams = new URLSearchParams(window.location.search);
  const cabang_id = urlParams.get('cabang'); //return pending_id or null

  // redirect if no cabang selected
  if (!cabang_id || cabang_id == 0) {
    window.location.href = '/shop';
  }

  var vue_product = new Vue({
    el: '#vue-product',
    data(){
      return {
        products: [],
      }
    },
    mounted() {
      //do something after mounting vue instance

    },
    created() {
      //do something after creating vue instance
      this.getProduct();
    },
    methods: {
      getProduct() {
        axios.get('product/cabang?cabang_id='+cabang_id).then((res)=>{
          console.log(res);
          this.products = res.data;
        }).catch((err)=>{
          console.log(err);
        })
      },

      addToCart(){
        // $auth.needAuthentication();
        // mini_cart_vue.item++;
        const payload = {

        }

        axios.post('/cart', ).then((res)=>{
          console.log(res);
          this.cart = res.data;
        }).catch((err)=>{
          console.log(err);
        });
      }
    }
  });
</script>
@endsection
