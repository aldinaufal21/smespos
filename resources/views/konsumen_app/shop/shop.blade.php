@extends('konsumen_app.layouts.app')

@section('title','Shop')

@section('extra_head')
<!-- Custom styles for this page -->
<style media="screen">

</style>
@endsection

@section('content')
<div id="vue-shop">
  <!-- main wrapper start -->
  <main>

      <breadcrumb :title="'Shop'"></breadcrumb>

      <!-- PILIH UMKM -->
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
                              <div class="col-md-4 col-sm-6" v-for="(elem, index) in umkm" :key="elem.umkm.umkm_id">
                                  <!-- product grid start -->
                                  <div class="product-item">
                                      <figure class="product-thumb">
                                          <a href="javascript:void(0)" @click="pilihCabang(index)">
                                            <img class="pri-img" :src="elem.umkm.gambar" alt="product">
                                            <img class="sec-img" :src="elem.umkm.gambar" alt="product">
                                          </a>
                                          <div class="button-group">
                                              <a href="#" data-toggle="modal" data-target="#umkm_detail"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
                                          </div>
                                      </figure>
                                      <div class="product-caption">
                                          <p class="product-name">
                                              <a href="product-details.html" v-text="elem.umkm.nama_umkm"></a>
                                          </p>
                                      </div>
                                  </div>
                                  <!-- product grid end -->

                                  <!-- product list item end -->
                                  <div class="product-list-item">
                                      <figure class="product-thumb">
                                          <a href="javascript:void(0)" @click="pilihCabang(index)">
                                              <img class="pri-img" :src="elem.umkm.gambar" alt="product">
                                              <img class="sec-img" :src="elem.umkm.gambar" alt="product">
                                          </a>
                                      </figure>
                                      <div class="product-content-list">
                                          <h5 class="product-name"><a href="product-details.html" v-text="elem.umkm.nama_umkm"></a></h5>
                                          <p v-text="elem.umkm.deskripsi"></p>
                                          <div class="button-group-list">
                                              <a href="#" data-toggle="modal" data-target="#umkm_detail"><span data-toggle="tooltip"  title="Quick View"><i class="lnr lnr-magnifier"></i></span></a>
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
      <!-- /PILIH UMKM -->
  </main>
  <!-- main wrapper end -->

  <!-- Quick view modal start -->
  <div class="modal" id="umkm_detail">
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

  <!-- PILIH CABANG -->
  <div class="modal" id="pilih-cabang">
      <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <h1>Pilih cabang, dimana anda ingin berbelanja: </h1>
                  <br>
                  <div class="list-group">
                     <a :href="`{{ route('konsumen.produk') }}?cabang=${cabang.cabang_id}`"
                        class="list-group-item list-group-item-action"
                        v-for="cabang in cabangs"
                        :key="cabang.cabang_id"
                        ><b>@{{ cabang.nama_cabang }}</b> <br> @{{ cabang.alamat_cabang }}</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- PILIH CABANG -->
</div>
@endsection

@section('extra_script')
<!-- Page level plugins -->
<script>
  var vue_shop = new Vue({
    el: '#vue-shop',
    // components: {
    //   breadcrumb: $breadcrumb
    // },
    data(){
      return {
        umkm: [],
        cabangs: [],
      }
    },
    mounted() {
      //do something after mounting vue instance
      console.log(this.$options.components);
    },
    created() {
      //do something after creating vue instance
      this.getUmkm();
      this.getCategory();
    },
    methods: {
      getUmkm() {
        axios.get('umkm-konsumen').then((res)=>{
          this.umkm = res.data;
        }).catch((err)=>{
          console.log(err);
        })
      },

      getCategory(){
        axios.get('category').then((res)=>{
          console.log(res);
        }).catch((err)=>{
          console.log(err);
        })
      },

      pilihCabang(index_umkm){
        this.cabangs = this.umkm[index_umkm].cabang;
        $('#pilih-cabang').modal('show');
      },
    }
  });
</script>
@endsection
