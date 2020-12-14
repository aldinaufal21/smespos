@extends('konsumen_app.layouts.app')

@section('title','Shop')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">
  .my-nice-select {
    height: 36px;
    line-height: 34px;
    width: 200px;
    padding: 0 10px;
  }

  .my-nice-select {
    -webkit-tap-highlight-color: transparent;
    background-color: #fff;
    border-radius: 5px;
    border: solid 1px #e8e8e8;
    box-sizing: border-box;
    clear: both;
    cursor: pointer;
    display: block;
    float: left;
    font-family: inherit;
    font-size: 14px;
    font-weight: normal;
    height: 42px;
    line-height: 40px;
    outline: none;
    padding-left: 18px;
    padding-right: 30px;
    position: relative;
    text-align: left !important;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    white-space: nowrap;
    width: auto;
  }

  .my-nice-select:hover {
    border-color: #dbdbdb;
  }

  .my-nice-select:active,
  .my-nice-select.open,
  .my-nice-select:focus {
    border-color: #999;
  }

  .my-nice-select:after {
    border-bottom: 2px solid #999;
    border-right: 2px solid #999;
    content: '';
    display: block;
    height: 5px;
    margin-top: -4px;
    pointer-events: none;
    position: absolute;
    right: 12px;
    top: 50%;
    -webkit-transform-origin: 66% 66%;
    -ms-transform-origin: 66% 66%;
    transform-origin: 66% 66%;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
    -webkit-transition: all 0.15s ease-in-out;
    transition: all 0.15s ease-in-out;
    width: 5px;
  }

  .my-nice-select.open:after {
    -webkit-transform: rotate(-135deg);
    -ms-transform: rotate(-135deg);
    transform: rotate(-135deg);
  }

  .my-nice-select.disabled {
    border-color: #ededed;
    color: #999;
    pointer-events: none;
  }

  .my-nice-select.disabled:after {
    border-color: #cccccc;
  }
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
                    <li v-for="(category, index) in categories" :key="category.kategori_produk_id">
                      <a href="javascript:void(0)" @click="getProductByCategory(category.kategori_produk_id)">
                        @{{ category.nama_kategori }} <span>@{{ category.total_produk }} </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <!-- single sidebar end -->

              <!-- single sidebar start -->
              {{-- <div class="sidebar-single">
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
              </div> --}}
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
                        <p>Showing @{{ products.length }} results</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-6 order-1 order-md-2">
                    <div class="top-bar-right">
                      <div class="product-short">
                        <p>Sort By : </p>
                        <select class="my-nice-select" id="reset-this" v-model="sortKey">
                          <option value="name-asc">Name (A - Z)</option>
                          <option value="name-desc">Name (Z - A)</option>
                          <option value="price-asc">Price (Low &gt; High)</option>
                          <option value="price-desc">Price (High &gt; Low)</option>
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
                        <a href="javascript:void(0)" @click="addToWishlist(produk.produk_id)" data-toggle="tooltip" data-placement="left" title="Add to wishlist">
                          <i class="lnr lnr-heart"></i>
                        </a>
                        <a href="javascript:void(0)" @click="showProductDetail(produk.produk_id)">
                          <span data-toggle="tooltip" data-placement="left" title="Quick View">
                            <i class="lnr lnr-magnifier"></i></span>
                        </a>
                        <a href="javascript:void(0)" @click="addToCart(produk.produk_id)" data-toggle="tooltip" data-placement="left" title="Add to Cart">
                          <i class="lnr lnr-cart"></i>
                        </a>
                      </div>
                    </figure>
                    <div class="product-caption">
                      <p class="product-name">
                        <a href="javascript:void(0)" @click="showProductDetail(produk.produk_id)" v-text="produk.nama_produk"></a>
                      </p>
                      <div class="price-box">
                        <span class="price-regular">Rp. @{{ rupiahFormat(produk.harga) }}</span>
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
                      <h5 class="product-name"><a href="javascript:void(0)" @click="showProductDetail(produk.produk_id)" v-text="produk.nama_produk"></a></h5>
                      <p v-text="produk.deskripsi_produk"></p>
                      <div class="button-group-list">
                        <a @click="addToCart(produk.produk_id)" class="btn-big" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add to Cart">
                          <i class="lnr lnr-cart"></i>Add to Cart
                        </a>
                        <a href="javascript:void(0)" @click="showProductDetail(produk.produk_id)">
                          <span data-toggle="tooltip" data-placement="top" title="Quick View">
                            <i class="lnr lnr-magnifier"></i></span>
                        </a>
                        <a href="javascript:void(0)" @click="addToWishlist(produk.produk_id)" data-toggle="tooltip" title="Add to wishlist">
                          <i class="lnr lnr-heart"></i>
                        </a>
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
  <div class="modal" id="quick_view">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <!-- product details inner end -->
          <div class="product-details-inner">
            <div class="row">
              <div class="col-lg-5 col-md-5">
                <div class="pro-large-img">
                  <img :src="productDetail ? productDetail.gambar_produk : ''" alt="product-details" />
                </div>
              </div>
              <div class="col-lg-7 col-md-7">
                <div class="product-details-des quick-details">
                  <h3 class="product-name">@{{ productDetail ? productDetail.nama_produk : "" }}</h3>
                  <div class="price-box">
                    <span class="price-regular">Rp. @{{ productDetail ? productDetail.harga : "" }}</span>
                    <!-- <span class="price-old"><del>$90.00</del></span> -->
                  </div>
                  <!-- <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                  <div class="product-countdown" data-countdown="2020/04/25"></div> -->
                  <div class="availability">
                    <i class="fa fa-check-circle"></i>
                    <span>Stok: @{{ productDetail ? productDetail.stok : "" }}</span>
                  </div>
                  <p class="pro-desc">@{{ productDetail ? productDetail.deskripsi_produk : "" }}</p>
                  <div class="quantity-cart-box d-flex align-items-center">
                    <h5>qty:</h5>
                    <div class="quantity">
                      <div class="pro-qty">
                        <input type="text" v-model="qtyToChart">
                      </div>
                    </div>
                    <div class="action_link">
                      <a class="btn btn-cart2" href="javascript:void(0)" @click="addToCart(productDetail.produk_id, qtyToChart)">Add to cart</a>
                    </div>
                  </div>
                  <div class="useful-links">
                    <a href="javascript:void(0)" @click="addToWishlist(productDetail.produk_id)" data-toggle="tooltip" title="Wishlist">
                      <i class="lnr lnr-heart"></i>
                      wishlist
                    </a>
                  </div>
                  <div class="like-icon">
                    <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                    <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                    <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- product details inner end -->
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
    data() {
      return {
        products: [],
        categories: [],
        sortBy: null,
        sortKey: null,
        productDetail: null,
        qtyToChart: 1,
      }
    },
    mounted() {
      //do something after mounting vue instance

    },
    created() {
      //do something after creating vue instance
      this.getProduct();
      this.getCategories();
    },
    methods: {
      getProduct() {
        axios.get('product/cabang?cabang_id=' + cabang_id).then((res) => {
          // console.log(res);
          this.products = res.data;
        }).catch((err) => {
          console.log(err);
        })
      },

      getCategories() {
        axios.get('category/?id_cabang=' + cabang_id).then((res) => {
          // console.log(res);
          this.categories = res.data;
        }).catch((err) => {
          console.log(err);
        })
      },

      addToCart(produk_id, _quantity = 1) {
        // $auth.needAuthentication();
        // mini_cart_vue.item++;
        $.LoadingOverlay("show");

        const payload = {
          produk_id: produk_id,
          quantity: _quantity,
          cabang_id: cabang_id
        }

        cartStore.addCart(payload).then((res) => {
          mini_cart_vue.updateCart();
        }).finally(()=>{
          $.LoadingOverlay("hide");
        });
      },

      addToWishlist(produk_id) {
        axios.post('favorite-product', {
          produk_id: produk_id
        }).then((res) => {
          console.log(res);
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

      getProductByCategory(categoryId) {
        axios.get('/product/?id_kategori[]=' + categoryId).then((res) => {
          // console.log(res);
          this.products = res.data;
          this.sortKey = null;
        }).catch((err) => {
          console.log(err);
          $helper.errorModal(err);
        })
      },

      sortProduct() {
        switch (this.sortKey) {
          case 'name-asc':
            this.sortName('asc');
            break;
          case 'name-desc':
            this.sortName('desc');
            break;
          case 'price-asc':
            this.sortPrice('asc');
            break;
          case 'price-desc':
            this.sortPrice('desc');
            break;
        }
      },

      sortName(sortType) {
        if (sortType == 'asc') {
          this.products.sort(function(a, b) {
            if (a.nama_produk < b.nama_produk) {
              return -1;
            }
            if (a.nama_produk > b.nama_produk) {
              return 1;
            }
            return 0;
          });
        } else {
          this.products.sort(function(a, b) {
            if (a.nama_produk < b.nama_produk) {
              return 1;
            }
            if (a.nama_produk > b.nama_produk) {
              return -1;
            }
            return 0;
          });
        }
      },

      sortPrice(sortType) {
        if (sortType == 'asc') {
          this.products.sort(function(a, b) {
            if (a.harga < b.harga) {
              return -1;
            }
            if (a.harga > b.harga) {
              return 1;
            }
            return 0;
          });
        } else {
          this.products.sort(function(a, b) {
            if (a.harga < b.harga) {
              return 1;
            }
            if (a.harga > b.harga) {
              return -1;
            }
            return 0;
          });
        }
      },

      showProductDetail(idProduk) {
        axios.get('product/' + idProduk).then((res) => {
          this.productDetail = res.data;
          $('#quick_view').modal('show');
        }).catch((err) => {
          console.log(err);
          $helper.errorModal(err);
        })
      },

      rupiahFormat(value){
        return $helper.rupiahFormat(value);
      },
    },
    watch: {
      sortKey: function(newVal, oldVal) {
        this.sortProduct();
      }
    }
  });
</script>
@endsection
